<?php

namespace Omnipay\Paybox\Message;

/**
 * Paybox Purchase Request
 */
class PurchaseRequest extends SystemAuthorizeRequest
{
    public function getTransactionType()
    {
        return '00003';
    }
}
