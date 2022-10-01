<?php

/*
 * Cash Register Remote API implementation for MyPos
 * Copyright (C) 2022 Lelyfoto / Michael Erkens
 *
 * For the full copyright and license information, please view the LICENSE
 */

declare(strict_types=1);

namespace Lelyfoto\MyPos\CashRegisterRemote\Soap;

use Lelyfoto\MyPos\CashRegisterRemote\Config;
use Lelyfoto\MyPos\CashRegisterRemote\Soap\Request;
use Lelyfoto\MyPos\CashRegisterRemote\Soap\Response;
use Lelyfoto\MyPos\CashRegisterRemote\Soap\Signature\SignatureCalculator;
use Phpro\SoapClient\Caller\Caller;
use Phpro\SoapClient\Caller\EngineCaller;
use Phpro\SoapClient\Caller\EventDispatchingCaller;
use Phpro\SoapClient\Soap\DefaultEngineFactory;
use Soap\ExtSoapEngine\ExtSoapOptions;
use Symfony\Component\EventDispatcher\EventDispatcher;

class Client
{
    protected readonly Caller $caller;
    protected readonly SignatureCalculator $signatureCalculator;

    public function __construct(Config $config)
    {
        $engine = DefaultEngineFactory::create(
            ExtSoapOptions::defaults($config->getMyPosWsdl(), [])
                ->withClassMap(Classmap::getCollection())
        );

        $eventDispatcher = new EventDispatcher();
        $this->caller = new EventDispatchingCaller(new EngineCaller($engine), $eventDispatcher);
        $this->signatureCalculator = new SignatureCalculator($config);
    }

    public function mPRSubscribe(Request\MPRSubscribe $request): Response\MPRSubscribeResponse
    {
        $this->signatureCalculator->calculateRequestSignature($request);
        return ($this->caller)('MPRSubscribe', $request);
    }

    public function mPRPurchase(Request\MPRPurchase $request): Response\MPRPurchaseResponse
    {
        $this->signatureCalculator->calculateRequestSignature($request);
        return ($this->caller)('MPRPurchase', $request);
    }

    public function mPRRefund(Request\MPRRefund $request): Response\MPRRefundResponse
    {
        $this->signatureCalculator->calculateRequestSignature($request);
        return ($this->caller)('MPRRefund', $request);
    }

    public function mPRLastTxnVoid(Request\MPRLastTxnVoid $request): Response\MPRLastTxnVoidResponse
    {
        $this->signatureCalculator->calculateRequestSignature($request);
        return ($this->caller)('MPRLastTxnVoid', $request);
    }

    public function mPRCancel(Request\MPRCancel $request): Response\MPRCancelResponse
    {
        $this->signatureCalculator->calculateRequestSignature($request);
        return ($this->caller)('MPRCancel', $request);
    }

    public function mPRGetTxnStatus(Request\MPRGetTxnStatus $request): Response\MPRGetTxnStatusResponse
    {
        $this->signatureCalculator->calculateRequestSignature($request);
        return ($this->caller)('MPRGetTxnStatus', $request);
    }
}
