<?php

namespace Omnipay\Paybox\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Common\Message\RedirectResponseInterface;


/**
 * Stripe Response
 */
class Response extends AbstractResponse implements RedirectResponseInterface
{
    public $endpoint = 'https://preprod-tpeweb.paybox.com/cgi/MYchoix_pagepaiement.cgi';

    public function __construct(RequestInterface $request, $data)
    {
        $this->request = $request;
        $this->data = $data;
      //  $this->redirectUrl = $redirectUrl;
    }

    public function isSuccessful()
    {
        return FALSE;
    }

    public function isRedirect()
    {
        return TRUE;
    }

    public function isTransparentRedirect()
    {
      return FALSE;
    }

    public function getRedirectUrl()
    {
      return $this->endpoint .'?'.http_build_query($this->data);
    }

    public function getRedirectMethod()
    {
        return 'GET';
    }

    public function getRedirectData()
    {
        return $this->getData();
    }

    public function getRedirectResponseHiddenFields() {
      $hiddenFields = '';
      foreach ($this->getRedirectData() as $key => $value) {
        $hiddenFields .= sprintf(
            '<input type="hidden" name="%1$s" value="%2$s" />',
            htmlentities($key, ENT_QUOTES, 'UTF-8', false),
            htmlentities($value, ENT_QUOTES, 'UTF-8', false)
          )."\n";
      }
      return $hiddenFields;
    }
}