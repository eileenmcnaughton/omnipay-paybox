<?php

namespace Omnipay\Paybox\Message;

/**
 * Paybox Purchase Request
 */
class SystemPurchaseRequest extends SystemAuthorizeRequest
{
    protected $onlyAuthorize = false;

    public function getTransactionType()
    {
        return '00003';
    }

    public function sendData($data)
    {
        return $this->response = new SystemResponse($this, $data, $this->getEndpoint());
    }
}
