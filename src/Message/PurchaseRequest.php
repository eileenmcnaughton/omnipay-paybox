<?php

namespace Omnipay\Paybox\Message;

/**
 * Cybersource Purchase Request
 */
class PurchaseRequest extends SystemAuthorizeRequest
{
    public function getTransactionType()
    {
        return '00003';
    }
}
