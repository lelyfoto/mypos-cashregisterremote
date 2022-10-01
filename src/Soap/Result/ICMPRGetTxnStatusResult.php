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

class ICMPRGetTxnStatusResult extends ICResult
{
    public function __construct(
        private readonly ?string $aid,
        private readonly ?string $aid_name,
        private readonly ?string $amount,
        private readonly ?string $auth_code,
        private readonly ?string $emboss_name,
        private readonly ?string $masked_pan,
        private readonly ?string $merch_address_line1,
        private readonly ?string $merch_address_line2,
        private readonly ?string $merch_name,
        private readonly ?string $merch_txn_date,
        private readonly ?string $merch_txn_time,
        private readonly ?string $mid,
        private readonly ?string $original_method,
        private readonly ?string $payment_reference,
        private readonly ?string $reference_number,
        private readonly ?string $reference_number_type,
        private readonly ?string $response_code,
        private readonly ?string $rrn,
        private readonly string $ruid,
        private readonly ?string $ruid_original,
        private readonly ?int $ruid_original_status,
        private readonly ?string $signature_required,
        private readonly ?string $stan,
        private readonly ?string $tid
    ) {
        parent::__construct();
    }

    public function getAid(): string
    {
        return $this->aid;
    }

    public function getAidName(): string
    {
        return $this->aid_name;
    }

    public function getAmount(): string
    {
        return $this->amount;
    }

    public function getAuthCode(): string
    {
        return $this->auth_code;
    }

    public function getEmbossName(): string
    {
        return $this->emboss_name;
    }

    public function getMaskedPan(): string
    {
        return $this->masked_pan;
    }

    public function getMerchAddressLine1(): string
    {
        return $this->merch_address_line1;
    }

    public function getMerchAddressLine2(): string
    {
        return $this->merch_address_line2;
    }

    public function getMerchName(): string
    {
        return $this->merch_name;
    }

    public function getMerchTxnDate(): string
    {
        return $this->merch_txn_date;
    }

    public function getMerchTxnTime(): string
    {
        return $this->merch_txn_time;
    }

    public function getMid(): string
    {
        return $this->mid;
    }

    public function getOriginalMethod(): string
    {
        return $this->original_method;
    }

    public function getPaymentReference(): string
    {
        return $this->payment_reference;
    }

    public function getReferenceNumber(): string
    {
        return $this->reference_number;
    }

    public function getReferenceNumberType(): string
    {
        return $this->reference_number_type;
    }

    public function getResponseCode(): string
    {
        return $this->response_code;
    }

    public function getRrn(): string
    {
        return $this->rrn;
    }

    public function getRuid(): string
    {
        return $this->ruid;
    }

    public function getRuidOriginal(): string
    {
        return $this->ruid_original;
    }

    public function getRuidOriginalStatus(): ?StatusMessage
    {
        return StatusMessage::getStatusByNumber($this->ruid_original_status ?? -1);
    }

    public function getSignatureRequired(): string
    {
        return $this->signature_required;
    }

    public function getStan(): string
    {
        return $this->stan;
    }

    public function getTid(): string
    {
        return $this->tid;
    }
}
