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

class MPRRefund extends AbstractRequest
{
    private readonly string $amount;

    public function __construct(Config $config, string $amount)
    {
        parent::__construct($config);
        $this->amount = $amount;
    }

    public function getAmount(): string
    {
        return $this->amount;
    }
}
