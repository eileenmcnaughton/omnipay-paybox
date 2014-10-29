<?php

namespace Omnipay\Paybox\Message;

use Omnipay\Common\Exception\InvalidRequestException;

/**
 * Authorize.Net Abstract Request
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    public function validateCardFields () {
        $card = $this->getCard();
        foreach ($this->getRequiredCardFields() as $field) {
            $fn = 'get' . ucfirst($field);
            if (empty($card->$fn())) {
                throw new InvalidRequestException("The $field parameter is required");
            }
        }
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

    public function getRequiredFields() {
        return array_merge($this->getRequiredCardFields(), $this->getRequiredCardFields());
    }
}
