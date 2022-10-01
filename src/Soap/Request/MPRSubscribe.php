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

class MPRSubscribe extends AbstractRequest
{
    public const ACTION_SUBSCRIBE = 1;
    public const ACTION_UNSUBSCRIBE = 2;

    #[RequestSignature(5)]
    private string $currency;
    #[RequestSignature(6)]
    private int $action;

    public function __construct(
        Config $config,
        int $action = self::ACTION_SUBSCRIBE,
    ) {
        parent::__construct($config);
        $this->currency = $config->getCurrency();
        $this->action = $action;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getAction(): int
    {
        return $this->action;
    }
}
