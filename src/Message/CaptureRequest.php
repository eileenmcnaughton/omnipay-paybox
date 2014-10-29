<?php

namespace Omnipay\Paybox\Message;

/**
 * Paybox Authorize Request
 */
class CaptureRequest extends PurchaseRequest
{
    public function getTransactionType()
    {
        return '00002';
    }
}
