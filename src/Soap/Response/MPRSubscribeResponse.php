<?php

/*
 * Cash Register Remote API implementation for MyPos
 * Copyright (C) 2022 Lelyfoto / Michael Erkens
 *
 * For the full copyright and license information, please view the LICENSE
 */

declare(strict_types=1);

namespace Lelyfoto\MyPos\CashRegisterRemote\Soap\Response;

use Lelyfoto\MyPos\CashRegisterRemote\Soap\Result\ICMPRSubscribeResult;
use Phpro\SoapClient\Type\ResultInterface;

class MPRSubscribeResponse implements ResultInterface
{
    public function __construct(
        private readonly ICMPRSubscribeResult $MPRSubscribeResult
    ) {
    }

    public function getMPRSubscribeResult(): ICMPRSubscribeResult
    {
        return $this->MPRSubscribeResult;
    }
}

