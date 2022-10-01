<?php

/*
 * Cash Register Remote API implementation for MyPos
 * Copyright (C) 2022 Lelyfoto / Michael Erkens
 *
 * For the full copyright and license information, please view the LICENSE
 */

declare(strict_types=1);

namespace Lelyfoto\MyPos\CashRegisterRemote;

use Lelyfoto\MyPos\CashRegisterRemote\Soap\Client;
use Lelyfoto\MyPos\CashRegisterRemote\Soap\Exception\SubscribeResponseException;
use Lelyfoto\MyPos\CashRegisterRemote\Soap\Request\MPRCancel;
use Lelyfoto\MyPos\CashRegisterRemote\Soap\Request\MPRGetTxnStatus;
use Lelyfoto\MyPos\CashRegisterRemote\Soap\Request\MPRPurchase;
use Lelyfoto\MyPos\CashRegisterRemote\Soap\Request\MPRSubscribe;
use Lelyfoto\MyPos\CashRegisterRemote\Soap\StatusMessage;
use Lelyfoto\MyPos\CashRegisterRemote\Tools\RequestId;

class Terminal
{
    private Client $client;

    public function __construct(
        private readonly Config $config,
    ) {
        $this->client = new Client($config);
    }

    public function requestPairCodeForSubscribe(): string
    {
        return $this->requestPairCode(MPRSubscribe::ACTION_SUBSCRIBE);
    }

    public function requestPairCodeForUnsubscribe(): string
    {
        return $this->requestPairCode(MPRSubscribe::ACTION_UNSUBSCRIBE);
    }

    protected function requestPairCode(int $action): string
    {
        $request = new MPRSubscribe(
            $this->config,
            $action
        );
        $response = $this->client->mPRSubscribe($request);

        if ($response->getMPRSubscribeResult()->getStatus() !== StatusMessage::OK) {
            throw new SubscribeResponseException(
                $response->getMPRSubscribeResult()->getStatus(),
                $request,
                $response
            );
        }

        return $response->getMPRSubscribeResult()->getCode();
    }

    public function makePurchase(
        float $amount,
        string $reference,
        int $referenceType = MPRPurchase::TYPE_REFERENCE_NUMBER
    ): string {
        $request = new MPRPurchase(
            $this->config,
            $amount,
            $reference,
            $referenceType
        );
        $response = $this->client->mPRPurchase($request);

        if ($response->getMPRPurchaseResult()->getStatus() !== StatusMessage::OK) {
            throw new SubscribeResponseException(
                $response->getMPRPurchaseResult()->getStatus(),
                $request,
                $response
            );
        }

        return $response->getMPRPurchaseResult()->getRuid();
    }

    public function checkPayment(
        string $ruid,
    ): Soap\Result\ICMPRGetTxnStatusResult {
        $request = new MPRGetTxnStatus(
            $this->config,
            new RequestId($ruid)
        );
        $response = $this->client->mPRGetTxnStatus($request);

        if ($response->getMPRGetTxnStatusResult()->getStatus() !== StatusMessage::OK) {
            throw new SubscribeResponseException(
                $response->getMPRGetTxnStatusResult()->getStatus(),
                $request,
                $response
            );
        }
        return $response->getMPRGetTxnStatusResult();
    }

    public function cancelPayment(
        string $ruid,
    ): Soap\Result\ICMPRCancelResult
    {
        $request = new MPRCancel(
            $this->config,
            $ruid,
        );
        $response = $this->client->mPRCancel($request);

        return $response->getMPRCancelResult();
    }
}
