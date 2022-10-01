<?php

/*
 * Cash Register Remote API implementation for MyPos
 * Copyright (C) 2022 Lelyfoto / Michael Erkens
 *
 * For the full copyright and license information, please view the LICENSE
 */

declare(strict_types=1);

namespace Lelyfoto\MyPos\CashRegisterRemote\Soap\Request;

use Lelyfoto\MyPos\CashRegisterRemote\Config;
use Lelyfoto\MyPos\CashRegisterRemote\Soap\Signature\RequestSignature;
use Lelyfoto\MyPos\CashRegisterRemote\Soap\Signature\RequestWithSignatureInterface;
use Lelyfoto\MyPos\CashRegisterRemote\Soap\Signature\SignatureRequestTrait;
use Lelyfoto\MyPos\CashRegisterRemote\Tools\RequestId;
use Lelyfoto\MyPos\CashRegisterRemote\Tools\RequestIdGenerator;

abstract class AbstractRequest implements RequestWithSignatureInterface
{
    use SignatureRequestTrait;

    #[RequestSignature(4, 'requestId')]
    protected ?RequestId $ruid;
    #[RequestSignature(1)]
    protected string $version;
    #[RequestSignature(2)]
    protected string $login;
    #[RequestSignature(0, 'keyIndex')]
    protected int $key_index;
    #[RequestSignature(3, 'terminalId')]
    protected string $tid;

    protected function __construct(Config $config)
    {
        $this->version = $config::API_VERSION;
        $this->login = $config->getLogin();
        $this->key_index = $config->getKeyIndex();
        $this->tid = $config->getTid();
        $this->ruid = RequestIdGenerator::generate();
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getKeyIndex(): int
    {
        return $this->key_index;
    }

    public function getTerminalId(): string
    {
        return $this->tid;
    }

    public function getRequestId(): RequestId
    {
        return $this->ruid;
    }
}
