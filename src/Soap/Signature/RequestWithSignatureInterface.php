<?php

/*
 * Cash Register Remote API implementation for MyPos
 * Copyright (C) 2022 Lelyfoto / Michael Erkens
 *
 * For the full copyright and license information, please view the LICENSE
 */

declare(strict_types=1);

namespace Lelyfoto\MyPos\CashRegisterRemote\Soap\Signature;

use Phpro\SoapClient\Type\RequestInterface;

interface RequestWithSignatureInterface extends RequestInterface
{
    public function setSignature(string $signature): void;
}