<?php

namespace Omnipay\Paybox\Message;

/**
 * Paybox Authorize Request
 */
class DirectCaptureRequest extends PurchaseRequest
{
    public function getTransactionType()
    {
        return '00002';
    }
}
