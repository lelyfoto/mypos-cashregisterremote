<?php

/*
 * Cash Register Remote API implementation for MyPos
 * Copyright (C) 2022 Lelyfoto / Michael Erkens
 *
 * For the full copyright and license information, please view the LICENSE
 */

declare(strict_types=1);

namespace Lelyfoto\MyPos\CashRegisterRemote\Soap;

enum StatusMessage: int
{
    case OK = 0;                        // No errors, success.
    case E_MISSING_REQ_PARAMS = 1;      // Some of the required fields from the POST request are missing.
    case E_SIGNATURE_FAILED = 2;        // The parameter ‘signature’ is not valid.
    case E_SYSTEM_ERROR = 3;            // General system error. Please contact myPOS support.
    case E_INVALID_PARAMS = 4;          // One or more of the other parameters from the request are not valid.
    case E_UNSUPPORTED_CALL = 5;
    case E_DUPLICATE_TRANSMISSION = 6;  // The error will be returned when the partner system has sent a duplicated
                                        // request (based on the call method and the ruid for a particular partner).
    case E_INACTIVE_TID = 7;            // The error will be returned if the terminal is not Active.
    case E_INVALID_TID = 8;             // The error will be returned both if the TID is incorrect or if it is already
                                        // assigned to a partner.
    case E_NOT_SUFFICIENT_FUNDS = 9;
    case E_TRANSACTION_NOT_PERMITTED = 10;
    case E_PENDING_REQUEST = 11;        // The error will be returned when there is a pending request for this TID.
                                        // The partner system must cancel the pending request first in order to submit
                                        // a new one. The ruid will be returned within the status_msg property of the
                                        // response.
    case E_EXEEDED_ACCOUNT_LIMITS = 12; // The error will be returned when the transaction cannot be processed because
                                        // of reached merchant’s wallet account limits.
    case E_UNSUCCESSFUL_PAYMENT = 13;
    case E_CANCELLED_PAYMENT = 14;      // This message will be returned on MPRGetTxnStatus when the partner system has
                                        // cancelled the payment via MPRCancel call.
    case E_PENDING_PAYMENT = 15;        // This message will be returned on MPRGetTxnStatus when the payment request is
                                        // not paid and not cancelled yet.
    case E_TIMEOUT = 16;
    case E_TRANSACTION_IN_PROGRESS = 17;
    case E_UNDEFINED_ERROR = 99;        // Other unspecified error.

    public static function getStatusByNumber(int $number): ?self
    {
        foreach (self::cases() as $case) {
            if ($case->value === $number) {
                return $case;
            }
        }
        return null;
    }
}
