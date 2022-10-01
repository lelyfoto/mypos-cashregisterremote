<?php

/*
 * Cash Register Remote API implementation for MyPos
 * Copyright (C) 2022 Lelyfoto / Michael Erkens
 *
 * For the full copyright and license information, please view the LICENSE
 */

declare(strict_types=1);

namespace Lelyfoto\MyPos\CashRegisterRemote\Tools;

use Exception;

class RequestIdGenerator
{
    public function __invoke(): RequestId
    {
        return self::generate();
    }

    public static function generate(): RequestId
    {
        try {
            $id = date('YmdHis') . str_pad((string)random_int(0, PHP_INT_MAX), 20, '0', STR_PAD_LEFT);
        } catch (Exception) {
            $id = uniqid(date('YmdHis'), true);
        }
        return new RequestId($id);
    }
}
