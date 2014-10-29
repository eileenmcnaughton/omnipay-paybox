<?php

namespace Omnipay\Paybox;

use Omnipay\Tests\GatewayTestCase;
use Omnipay\Paybox\SystemGateway;

class SystemGatewayTest extends GatewayTestCase
{
  /**
   * @var Omnipay/Paybox/SystemGateway
   */
    public $gateway;

    public function setUp()
    {
        parent::setUp();

        $this->gateway = new SystemGateway($this->getHttpClient(), $this->getHttpRequest());
        $this->gateway->setSite(1999888);
        $this->gateway->setRang(32);
        $this->gateway->setIdentifiant(110647233);
    }

    public function testPurchase()
    {
        $response = $this->gateway->purchase(array('amount' => '10.00', 'currency' => 978))->send();
        $this->assertInstanceOf('Omnipay\Paybox\Message\SystemResponse', $response);
        $this->assertFalse($response->isSuccessful());
        $this->assertTrue($response->isRedirect());
        $this->assertNotEmpty($response->getRedirectUrl());

        $this->assertSame('https://preprod-tpeweb.paybox.com/cgi/MYchoix_pagepaiement.cgi?PBX_SITE=1999888&PBX_RANG=32&PBX_IDENTIFIANT=110647233&PBX_TOTAL=10.00', $response->getRedirectUrl());
    }

    public function testCompletePurchase()
    {
        $request = $this->gateway->completePurchase(array('amount' => '10.00'));

        $this->assertInstanceOf('Omnipay\Paybox\Message\SystemCompletePurchaseRequest', $request);
        $this->assertSame('10.00', $request->getAmount());
    }

    public function testCompletePurchaseSend()
    {
      $request = $this->gateway->purchase(array('amount' => '10.00', 'currency' => 'USD', 'card' => array(
        'firstName' => 'Pokemon',
        'lastName' => 'The second',
      )))->send();

      $this->assertInstanceOf('Omnipay\Paybox\Message\SystemResponse', $request);
      $this->assertFalse($request->isTransparentRedirect());
    }
}
