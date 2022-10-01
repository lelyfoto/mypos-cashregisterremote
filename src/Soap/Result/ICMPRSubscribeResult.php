<?php

/*
 * Cash Register Remote API implementation for MyPos
 * Copyright (C) 2022 Lelyfoto / Michael Erkens
 *
 * For the full copyright and license information, please view the LICENSE
 */

declare(strict_types=1);

namespace Lelyfoto\MyPos\CashRegisterRemote\Soap\Result;

class ICMPRSubscribeResult extends ICResult
{
    public function __construct(
        private readonly int $action,
        private readonly ?string $code,
        private readonly string $currency,
        private readonly string $ruid,
        private readonly string $tid
    ) {
        parent::__construct();
    }

    public function getAction(): int
    {
        return $this->action;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getRuid(): string
    {
        return $this->ruid;
    }

    public function getTid(): string
    {
        return $this->tid;
    }
}
