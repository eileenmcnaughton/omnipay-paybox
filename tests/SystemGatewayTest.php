<?php

namespace Omnipay\Paybox;

use Omnipay\Tests\GatewayTestCase;

class SystemGatewayTest extends GatewayTestCase
{
    /**
     * Key for test site - see http://www1.paybox.com/wp-content/uploads/2014/02/PayboxTestParameters_V6.2_EN.pdf
     * @var string
     */
    public $key = '0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF';

    /**
     * @var SystemGateway
     */
    public $gateway;

    /**
     * Test credentials site number.
     *
     * @var int
     */
    public $site = 1999888;

    /**
     * Test credentials RANG.
     *
     * @var int
     */
    public $rang = 32;

    public $identifiant = '107904482';

    public function setUp()
    {
        parent::setUp();

        $this->gateway = new SystemGateway($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testPurchase()
    {
        $request = $this->gateway->purchase(['amount' => '10.00']);

        $this->assertInstanceOf('Omnipay\Paybox\Message\SystemPurchaseRequest', $request);
        $this->assertSame('10.00', $request->getAmount());
        $this->assertSame('https://tpeweb.paybox.com/cgi/MYchoix_pagepaiement.cgi', $request->getEndpoint());
    }

    public function testPurchaseTestMode()
    {
        $request = $this->gateway->purchase(['amount' => '10.00', 'testMode' => true]);

        $this->assertInstanceOf('Omnipay\Paybox\Message\SystemPurchaseRequest', $request);
        $this->assertSame('10.00', $request->getAmount());
        $this->assertSame('https://preprod-tpeweb.paybox.com/cgi/MYchoix_pagepaiement.cgi', $request->getEndpoint());
    }

    public function testAuthorize()
    {
        $request = $this->gateway->authorize(['amount' => '10.00', 'testMode' => true]);

        $this->assertInstanceOf('Omnipay\Paybox\Message\SystemAuthorizeRequest', $request);
        $this->assertSame('10.00', $request->getAmount());
        $this->assertSame('https://preprod-tpeweb.paybox.com/cgi/MYchoix_pagepaiement.cgi', $request->getEndpoint());
    }

    public function testCompletePurchase()
    {
        $request = $this->gateway->completePurchase(['amount' => '10.00']);

        $this->assertInstanceOf('Omnipay\Paybox\Message\SystemCompletePurchaseRequest', $request);
        $this->assertSame('10.00', $request->getAmount());
    }

    public function testPurchaseSend()
    {
        $request = $this->gateway->purchase([
            'amount' => '10.00',
            'currency' => 'USD',
            'card' => [
                'firstName' => 'Pokemon',
                'lastName' => 'The second',
                'email' => 'test@paybox.com',
            ],
        ])->send();

        $this->assertInstanceOf('Omnipay\Paybox\Message\SystemResponse', $request);
        $this->assertFalse($request->isTransparentRedirect());
    }


    public function testPurchaseSendWithSiteData()
    {
        $gateway = $this->gateway->purchase([
            'amount' => '10.00',
            'currency' => 'EUR',
            'card' => [
                'firstName' => 'Pokemon',
                'lastName' => 'The second',
                'email' => 'test@paybox.com',
            ],
        ]);

        $gateway->setRang($this->rang);
        $gateway->setSite($this->site);
        $gateway->setIdentifiant($this->identifiant);
        $gateway->setTransactionID(3);
        $gateway->setTime("2014-12-09T22:37:34+00:00");
        $gateway->setKey($this->key);
        $request = $gateway->send();

        $this->assertInstanceOf('Omnipay\Paybox\Message\SystemResponse', $request);
        $this->assertFalse($request->isTransparentRedirect());
        $expectedUrl = "https://tpeweb.paybox.com/cgi/MYchoix_pagepaiement.cgi?PBX_SITE=1999888&PBX_RANG=32&PBX_IDENTIFIANT=107904482&PBX_TOTAL=1000&PBX_DEVISE=978&PBX_CMD=3&PBX_PORTEUR=test%40paybox.com&PBX_RETOUR=Mt%3AM%3BId%3AR%3BRef%3AA%3BErreur%3AE%3Bsign%3AK%3B3d%3AG&PBX_TIME=2014-12-09T22%3A37%3A34%2B00%3A00&PBX_HMAC=9701A68D320E2BFD1A70DBB184E3C15001ABD460E87469B9C9B1E93CE6EB002FDC418443290FC6C32F5AEA5ABA757E369B126B8E45C006EAFF216F9AD881BC9F";
        $this->assertSame($expectedUrl, $request->getRedirectUrl());
        $data = $request->getData();
        $this->assertArrayHasKey('PBX_RETOUR', $data);
        $this->assertArrayNotHasKey('PBX_AUTOSEULE', $data);
    }

    public function testAuthorizeSendWithSiteData()
    {
        $gateway = $this->gateway->authorize([
            'amount' => '10.00',
            'currency' => 'EUR',
            'card' => [
                'firstName' => 'Pokemon',
                'lastName' => 'The second',
                'email' => 'test@paybox.com',
            ],
        ]);

        $gateway->setRang($this->rang);
        $gateway->setSite($this->site);
        $gateway->setIdentifiant($this->identifiant);
        $gateway->setTransactionID(3);
        $gateway->setTime("2014-12-09T22:37:34+00:00");
        $gateway->setKey($this->key);
        $request = $gateway->send();

        $this->assertInstanceOf('Omnipay\Paybox\Message\SystemAuthorizeResponse', $request);
        $this->assertFalse($request->isTransparentRedirect());
        $expectedUrl = "https://tpeweb.paybox.com/cgi/MYchoix_pagepaiement.cgi";
        $this->assertSame($expectedUrl, $request->getRedirectUrl());
        $data = $request->getData();
        $this->assertArrayHasKey('PBX_RETOUR', $data);
        $this->assertArrayHasKey('PBX_AUTOSEULE', $data);
    }
}
