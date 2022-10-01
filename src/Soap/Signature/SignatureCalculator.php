<?php

/*
 * Cash Register Remote API implementation for MyPos
 * Copyright (C) 2022 Lelyfoto / Michael Erkens
 *
 * For the full copyright and license information, please view the LICENSE
 */

declare(strict_types=1);

namespace Lelyfoto\MyPos\CashRegisterRemote\Soap\Signature;

use Lelyfoto\MyPos\CashRegisterRemote\Config;
use Lelyfoto\MyPos\CashRegisterRemote\Soap\Exception\SignatureException;
use ReflectionClass;

class SignatureCalculator
{
    public function __construct(
        private readonly Config $config
    ) {
    }

    public function calculateRequestSignature(RequestWithSignatureInterface $request): void
    {
        $combined = implode(';', $this->getSignatureParamsForRequest($request));

        $private_key = openssl_pkey_get_private($this->config->getPrivateKey());

        $signature = '';
        openssl_sign($combined, $signature, $private_key, OPENSSL_ALGO_SHA256);

        $request->setSignature($signature);
    }

    private function getSignatureParamsForRequest(RequestWithSignatureInterface $requestObject): array
    {
        $signatureParams = [];
        $reflectionClass = new ReflectionClass(get_class($requestObject));
        foreach ($reflectionClass->getProperties() as $property) {
            $attributes = $property->getAttributes(RequestSignature::class);
            foreach ($attributes as $attribute) {
                /** @var RequestSignature $attributeInstance */
                $attributeInstance = $attribute->newInstance();
                $signatureParams[$attributeInstance->sortOrder] = $attributeInstance->name ?? $property->name;
            }
        }
        ksort($signatureParams);

        $params = [];
        foreach ($signatureParams as $paramName) {
            $methodName = 'get' . ucfirst($paramName);
            if (is_callable([$requestObject, $methodName])) {
                $params[] = $requestObject->$methodName();
            } else {
                throw new SignatureException(
                    'Field "' . $paramName . '" does not have a get-method, can not calculate signature'
                );
            }
        }
        return $params;
    }
}
