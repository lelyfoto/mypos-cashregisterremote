<?php

/*
 * Cash Register Remote API implementation for MyPos
 * Copyright (C) 2022 Lelyfoto / Michael Erkens
 *
 * For the full copyright and license information, please view the LICENSE
 */

declare(strict_types=1);

namespace Lelyfoto\MyPos\CashRegisterRemote\Soap\Exception;

use Lelyfoto\MyPos\CashRegisterRemote\Soap\StatusMessage;
use Phpro\SoapClient\Type\RequestInterface;
use Phpro\SoapClient\Type\ResultInterface;
use RuntimeException;

abstract class ResponseException extends RuntimeException
{
    public function __construct(
        public readonly StatusMessage $statusMessage,
        public readonly RequestInterface $request,
        public readonly ResultInterface $result
    ) {
        parent::__construct($statusMessage->name, $statusMessage->value);
    }
}
