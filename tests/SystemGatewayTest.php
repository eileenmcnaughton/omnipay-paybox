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
    }

    public function testPurchase()
    {
        $response = $this->gateway->purchase(array('amount' => '10.00', 'currency' => 978))->send();
        $this->assertFalse($response->isSuccessful());
        $this->assertTrue($response->isRedirect());
        $this->assertNotEmpty($response->getRedirectUrl());

      $response->getRedirectData();

      $request = $this->gateway->purchase(array('amount' => '10.00'));
      $this->assertInstanceOf('Omnipay\Paybox\Message\PurchaseRequest', $request);
      $this->assertSame('10.00', $request->getAmount());
      $this->assertFalse($response->isSuccessful());
      $this->assertTrue($response->isRedirect());
      $this->assertNotEmpty($response->getRedirectUrl());

      $this->assertSame('https://preprod-tpeweb.paybox.com/cgi/MYchoix_pagepaiement.cgi?', $response->getRedirectUrl());
    }

    public function testCompletePurchase()
    {
        $request = $this->gateway->completePurchase(array('amount' => '10.00'));

        $this->assertInstanceOf('Omnipay\Paybox\Message\CompletePurchaseRequest', $request);
        $this->assertSame('10.00', $request->getAmount());
    }

    public function testCompletePurchaseSend()
    {
      $request = $this->gateway->purchase(array('amount' => '10.00', 'currency' => 'USD', 'card' => array(
        'firstName' => 'Pokemon',
        'lastName' => 'The second',
      )))->send();

      $this->assertInstanceOf('Omnipay\Paybox\Message\Response', $request);
      $this->assertFalse($request->isTransparentRedirect());
    }
}
