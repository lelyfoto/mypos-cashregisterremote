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

class MPRPurchase extends AbstractRequest
{
    public const TYPE_REFERENCE_NUMBER = 1;
    public const TYPE_INVOICE_NUMBER = 2;
    public const TYPE_PRODUCT_ID = 3;
    public const TYPE_RESERVATION_NUMBER = 4;

    #[RequestSignature(5)]
    private string $amount;
    #[RequestSignature(6, 'referenceNumber')]
    private string $reference_number;
    #[RequestSignature(7, 'referenceNumberType')]
    private int $reference_number_type;

    public function __construct(
        Config $config,
        float $amount,
        string $referenceNumber,
        int $referenceNumberType = self::TYPE_REFERENCE_NUMBER,
    ) {
        parent::__construct($config);
        $this->amount = number_format($amount, 2, '.', '');
        $this->reference_number = $referenceNumber;
        $this->reference_number_type = $referenceNumberType;
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
}
