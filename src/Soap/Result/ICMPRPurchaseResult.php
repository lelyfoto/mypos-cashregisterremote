<?php

/*
 * Cash Register Remote API implementation for MyPos
 * Copyright (C) 2022 Lelyfoto / Michael Erkens
 *
 * For the full copyright and license information, please view the LICENSE
 */

declare(strict_types=1);

namespace Lelyfoto\MyPos\CashRegisterRemote\Soap\Result;

class ICMPRPurchaseResult extends ICResult
{
    public function __construct(
        private readonly string $amount,
        private readonly string $reference_number,
        private readonly int $reference_number_type,
        private readonly string $ruid,
        private readonly string $tid
    ) {
        parent::__construct();
    }

    public function getAmount(): string
    {
        return $this->amount;
    }

    public function getReferenceNumber(): string
    {
        return $this->reference_number;
    }

    public function getReferenceNumberType(): int
    {
        return $this->reference_number_type;
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
