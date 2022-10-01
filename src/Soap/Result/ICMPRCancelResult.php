<?php

/*
 * Cash Register Remote API implementation for MyPos
 * Copyright (C) 2022 Lelyfoto / Michael Erkens
 *
 * For the full copyright and license information, please view the LICENSE
 */

declare(strict_types=1);

namespace Lelyfoto\MyPos\CashRegisterRemote\Soap\Result;

class ICMPRCancelResult extends ICResult
{
    public function __construct(
        private readonly string $ruid,
        private readonly string $ruid_original,
        private readonly string $tid
    ) {
        parent::__construct();
    }

    public function getRuid(): string
    {
        return $this->ruid;
    }

    public function getRuidOriginal(): string
    {
        return $this->ruid_original;
    }

    public function getTid(): string
    {
        return $this->tid;
    }
}
