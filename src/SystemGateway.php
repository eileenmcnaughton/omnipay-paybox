<?php

namespace Omnipay\Paybox;

use Omnipay\Common\AbstractGateway;

/**
 * Paybox System Gateway
 *
 */
class SystemGateway extends AbstractGateway
{

    public function getName()
    {
        return 'PayboxSystem';
    }

    public function getDefaultParameters()
    {
        return [
            'site' => '',
            'rang' => '',
            'identifiant' => '',
            'key' => '',
            'testMode' => false,
        ];
    }

    /**
     *
     * @param array $parameters
     * @return \Omnipay\Paybox\Message\SystemAuthorizeRequest
     */
    public function authorize(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Paybox\Message\SystemAuthorizeRequest', $parameters);
    }

    /**
     *
     * @param array $parameters
     * @return \Omnipay\Paybox\Message\SystemCaptureRequest
     */
    public function capture(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Paybox\Message\SystemCaptureRequest', $parameters);
    }

    /**
     *
     * @param array $parameters
     * @return \Omnipay\Paybox\Message\SystemPurchaseRequest
     */
    public function purchase(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Paybox\Message\SystemPurchaseRequest', $parameters);
    }

    /**
     * Complete purchase.
     *
     * e.g based on an IPN or silent url type notification from a processor.
     *
     * @param array $parameters
     * @return \Omnipay\Paybox\Message\SystemCompletePurchaseRequest
     */
    public function completePurchase(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Paybox\Message\SystemCompletePurchaseRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return \Omnipay\Paybox\Message\SystemCompleteAuthorizeRequest
     */
    public function completeAuthorize(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Paybox\Message\SystemCompleteAuthorizeRequest', $parameters);
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

    public function getKey()
    {
        return $this->getParameter('key');
    }

    public function setKey($value)
    {
        return $this->setParameter('key', $value);
    }


    public function getTransactionType()
    {
        return $this->getParameter('transactionType');
    }

    public function setTransactionType($value)
    {
        return $this->setParameter('transactionType', $value);
    }
}
