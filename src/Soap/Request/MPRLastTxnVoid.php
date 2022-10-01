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
use Lelyfoto\MyPos\CashRegisterRemote\Tools\RequestId;

class MPRLastTxnVoid extends AbstractRequest
{
    #[RequestSignature(5, 'ruidOriginal')]
    private RequestId $ruid_original;
    #[RequestSignature(6)]
    private string $amount;

    public function __construct(
        Config $config,
        float $amount,
        RequestId $ruid_original,
    ) {
        parent::__construct($config);
        $this->ruid_original = $ruid_original;
        $this->amount = number_format($amount, 2, '.', '');
    }

    public function getRuidOriginal(): RequestId
    {
        return $this->ruid_original;
    }

    public function getAmount(): string
    {
        return $this->amount;
    }
}
