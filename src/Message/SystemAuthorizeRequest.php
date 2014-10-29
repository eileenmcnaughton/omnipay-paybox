<?php

namespace Omnipay\Paybox\Message;

use Omnipay\Paybox\Message\AbstractRequest;

/**
 * Paybox System Authorize Request
 */
class SystemAuthorizeRequest extends AbstractRequest
{

    public function getData()
    {
        $this->validate('currency', 'amount');
        return $this->getBaseData() + $this->getTransactionData();
    }

    public function sendData($data)
    {
        $httpResponse = $this->httpClient->post($this->getEndpoint(), null, $data)->send();
        return $this->createResponse($httpResponse);
    }

    protected function createResponse($data)
    {
        return $this->response = new Response($this, $data);
    }

    public function getSite()
    {
        return $this->getParameter('site');
    }

    public function setSite($value)
    {
        return $this->setParameter('site', $value);
    }

    public function getRang()
    {
        return $this->getParameter('rang');
    }

    public function setRang($value)
    {
        return $this->setParameter('rang', $value);
    }

    public function getIdentifiant()
    {
        return $this->getParameter('identifiant');
    }

    public function setIdentifiant($value)
    {
        return $this->setParameter('identifiant', $value);
    }

    public function getRequiredFields()
    {
        return array
        (
            'amount',
            'email',
            'currency',
        );
    }

    public function getTransactionData()
    {
        return array
        (
            'PBX_CMD' => $this->getTransactionId(),
            'PBX_TOTAL' => $this->getAmount(),
            'PBX_DEVISE' => $this->getCurrencyNumeric(),
        );
    }

    /**
     * @return array
     */
    public function getBaseData()
    {
        return array(
            'PBX_SITE' => $this->getSite(),
            'PBX_RANG' => $this->getRang(),
            'PBX_IDENTIFIANT' => $this->getIdentifiant(),
            //@todo where should this be set ?
            // 00103 for Paybox Direct
            // 00104 for Paybox Direct Plus
            'VERSION' => '00103',
            'DATEQ' => date('dmYhis'),
            'NUMQUESTION' => substr(uniqid(), 0, 10),
            'TYPE' => $this->getTransactionType()
        );
    }

    /**
     * @return string
     */
    public function getUniqueID()
    {
        return uniqid();
    }

    /**
    * @return string
    * http://www1.paybox.com/wp-content/uploads/2014/02/ManuelIntegrationPayboxSystem_V6.2_EN.pdf
    */
    public function getEndpoint()
    {
        return 'https://preprod-tpeweb.paybox.com/cgi/MYchoix_pagepaiement.cgi';
    }

    public function getPaymentMethod()
    {
        return 'card';
    }

    public function getTransactionType()
    {
        return '00001';
    }
}
