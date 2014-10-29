<?php
namespace Omnipay\Paybox;

use Omnipay\Common\AbstractGateway;
use Omnipay\Paybox\Message\DirectPurchaseRequest;
use Omnipay\Paybox\Message\DirectRefundRequest;

/**
 * Paybox System Gateway
 *
 * @link http://www1.paybox.com/wp-content/uploads/2014/06/ManuelIntegrationPayboxDirect_V6.3_EN.pdf
 * @link http://www1.paybox.com/wp-content/uploads/2014/02/PayboxTestParameters_V6.2_EN.pdf
 */
class DirectGateway extends SystemGateway
{

    public function getName()
    {
        return 'PayboxDirect';
    }


    /**
     *
     * @param array $parameters
     * @return \Omnipay\Paybox\Message\DirectAuthorizeRequest
     */
    public function authorize(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\PayboxDirect\Message\DirectAuthorizeRequest', $parameters);
    }

    /**
     *
     * @param array $parameters
     * @return \Omnipay\Paybox\Message\DirectCaptureRequest
     */
    public function capture(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Paybox\Message\DirectCaptureRequest', $parameters);
    }

    /**
     *
     * @param array $parameters
     * @return \Omnipay\Paybox\Message\DirectPurchaseRequest
     */
    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Paybox\Message\DirectPurchaseRequest', $parameters);
    }

    /**
     *
     * @param array $parameters
     * @return \Omnipay\Paybox\Message\DirectCompletePurchaseRequest
     */
    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Paybox\Message\DirectCompletePurchaseRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return \Omnipay\Paybox\Message\DirectCompleteAuthorizeRequest
     */
    public function completeAuthorize(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Paybox\Message\DirectCompleteAuthorizeRequest', $parameters);
    }

    /**
     *
     * @param array $parameters
     * @return \Omnipay\Paybox\Message\DirectCreateCardRequest
     */
    public function createCard(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Paybox\Message\DirectCreateCardRequest', $parameters);
    }

    /**
     *
     * @param array $parameters
     * @return \Omnipay\Paybox\Message\DirectUpdateCardRequest
     */
    public function updateCard(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Paybox\Message\DirectUpdateCardRequest', $parameters);
    }
}
