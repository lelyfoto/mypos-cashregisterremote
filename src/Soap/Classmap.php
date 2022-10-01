<?php

/*
 * Cash Register Remote API implementation for MyPos
 * Copyright (C) 2022 Lelyfoto / Michael Erkens
 *
 * For the full copyright and license information, please view the LICENSE
 */

declare(strict_types=1);


namespace Lelyfoto\MyPos\CashRegisterRemote\Soap;

use Soap\ExtSoapEngine\Configuration\ClassMap\ClassMap as SoapClassMap;
use Soap\ExtSoapEngine\Configuration\ClassMap\ClassMapCollection;

class Classmap
{
    public static function getCollection(): ClassMapCollection
    {
        return new ClassMapCollection(
            new SoapClassMap('iCMPRSubscribeResult', Result\ICMPRSubscribeResult::class),
            new SoapClassMap('iCResult', Result\ICResult::class),
            new SoapClassMap('iCMPRPurchaseResult', Result\ICMPRPurchaseResult::class),
            new SoapClassMap('iCMPRRefundResult', Result\ICMPRRefundResult::class),
            new SoapClassMap('iCMPRLastTxnVoidResult', Result\ICMPRLastTxnVoidResult::class),
            new SoapClassMap('iCMPRCancelResult', Result\ICMPRCancelResult::class),
            new SoapClassMap('iCMPRGetTxnStatusResult', Result\ICMPRGetTxnStatusResult::class),
            new SoapClassMap('MPRSubscribe', Request\MPRSubscribe::class),
            new SoapClassMap('MPRSubscribeResponse', Response\MPRSubscribeResponse::class),
            new SoapClassMap('MPRPurchase', Request\MPRPurchase::class),
            new SoapClassMap('MPRPurchaseResponse', Response\MPRPurchaseResponse::class),
            new SoapClassMap('MPRRefund', Request\MPRRefund::class),
            new SoapClassMap('MPRRefundResponse', Response\MPRRefundResponse::class),
            new SoapClassMap('MPRLastTxnVoid', Request\MPRLastTxnVoid::class),
            new SoapClassMap('MPRLastTxnVoidResponse', Response\MPRLastTxnVoidResponse::class),
            new SoapClassMap('MPRCancel', Request\MPRCancel::class),
            new SoapClassMap('MPRCancelResponse', Response\MPRCancelResponse::class),
            new SoapClassMap('MPRGetTxnStatus', Request\MPRGetTxnStatus::class),
            new SoapClassMap('MPRGetTxnStatusResponse', Response\MPRGetTxnStatusResponse::class),
        );
    }
}
