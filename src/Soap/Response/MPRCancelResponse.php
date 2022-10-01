<?php

/*
 * Cash Register Remote API implementation for MyPos
 * Copyright (C) 2022 Lelyfoto / Michael Erkens
 *
 * For the full copyright and license information, please view the LICENSE
 */

declare(strict_types=1);

namespace Lelyfoto\MyPos\CashRegisterRemote\Soap\Response;

use Lelyfoto\MyPos\CashRegisterRemote\Soap\Result\ICMPRCancelResult;
use Phpro\SoapClient\Type\ResultInterface;

class MPRCancelResponse implements ResultInterface
{
    public function __construct(
        private readonly ICMPRCancelResult $MPRCancelResult
    ) {
    }

    public function getMPRCancelResult(): ICMPRCancelResult
    {
        return $this->MPRCancelResult;
    }
}
