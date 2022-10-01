<?php

/*
 * Cash Register Remote API implementation for MyPos
 * Copyright (C) 2022 Lelyfoto / Michael Erkens
 *
 * For the full copyright and license information, please view the LICENSE
 */

declare(strict_types=1);

namespace Lelyfoto\MyPos\CashRegisterRemote\Soap\Result;

use Lelyfoto\MyPos\CashRegisterRemote\Soap\StatusMessage;

class ICResult
{
    public function __construct(
        protected ?int $key_index = null,
        protected ?string $login = null,
        protected ?string $method_name = null,
        protected ?string $signature = null,
        protected ?int $status = null,
        protected ?string $status_msg = null,
        protected ?string $version = null
    ) {
    }

    public function getKeyIndex(): int
    {
        return $this->key_index;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getMethodName(): string
    {
        return $this->method_name;
    }

    public function getSignature(): string
    {
        return $this->signature;
    }

    public function getStatus(): ?StatusMessage
    {
        return StatusMessage::getStatusByNumber($this->status ?? -1);
    }

    public function getStatusMsg(): string
    {
        return $this->status_msg;
    }

    public function getVersion(): string
    {
        return $this->version;
    }
}
