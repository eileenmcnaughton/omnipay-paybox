<?php

namespace Omnipay\Paybox;

use Omnipay\Tests\GatewayTestCase;

class DirectGatewayTest extends GatewayTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->gateway = new DirectGateway($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testPurchase()
    {
        $request = $this->gateway->purchase(array('amount' => '10.00'));

        $this->assertInstanceOf('Omnipay\Paybox\Message\DirectPurchaseRequest', $request);
        $this->assertSame('10.00', $request->getAmount());
    }
}
