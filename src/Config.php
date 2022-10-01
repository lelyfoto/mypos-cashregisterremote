<?php

/*
 * Cash Register Remote API implementation for MyPos
 * Copyright (C) 2022 Lelyfoto / Michael Erkens
 *
 * For the full copyright and license information, please view the LICENSE
 */

declare(strict_types=1);

namespace Lelyfoto\MyPos\CashRegisterRemote;

class Config
{
    public const API_VERSION = '3.0';
    public const MYPOS_WSDL_PRODUCTION = 'https://crr-api.mypos.com/?wsdl';
    public const MYPOS_WSDL_TEST = 'http://185.161.235.90:34206/infromhttp';

    public function __construct(
        private readonly string $login,
        private readonly int $keyIndex,
        private readonly string $currency,
        private readonly string $tid,
        private readonly string $privateKey,
        private readonly string $myPosPublicCertificate,
        private readonly string $myPosWsdl = self::MYPOS_WSDL_PRODUCTION
    ) {
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getKeyIndex(): int
    {
        return $this->keyIndex;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getTid(): string
    {
        return $this->tid;
    }

    public function getPrivateKey(): string
    {
        return $this->privateKey;
    }

    public function getMyPosPublicCertificate(): string
    {
        return $this->myPosPublicCertificate;
    }

    public function getMyPosWsdl(): string
    {
        return $this->myPosWsdl;
    }
}
