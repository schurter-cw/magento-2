<?php
/**
 * wallee Magento 2
 *
 * This Magento 2 extension enables to process payments with wallee (https://www.wallee.com/).
 *
 * @package Wallee_Payment
 * @author customweb GmbH (http://www.customweb.com/)
 * @license http://www.apache.org/licenses/LICENSE-2.0  Apache Software License (ASL 2.0)
 */
namespace Wallee\Payment\Model\Provider;

use Magento\Framework\Cache\FrontendInterface;
use Wallee\Payment\Model\ApiClient;
use Wallee\Sdk\Service\PaymentMethodService;

/**
 * Provider of payment method information from the gateway.
 */
class PaymentMethodProvider extends AbstractProvider
{

    /**
     *
     * @var ApiClient
     */
    private $apiClient;

    /**
     *
     * @param FrontendInterface $cache
     * @param ApiClient $apiClient
     */
    public function __construct(FrontendInterface $cache, ApiClient $apiClient)
    {
        parent::__construct($cache, 'wallee_payment_methods');
        $this->apiClient = $apiClient;
    }

    /**
     * Gets the payment method by the given id.
     *
     * @param int $id
     * @return \Wallee\Sdk\Model\PaymentMethod
     */
    public function find($id)
    {
        return parent::find($id);
    }

    /**
     * Gets a list of payment methods.
     *
     * @return \Wallee\Sdk\Model\PaymentMethod[]
     */
    public function getAll()
    {
        return parent::getAll();
    }

    protected function fetchData()
    {
        return $this->apiClient->getService(PaymentMethodService::class)->all();
    }

    protected function getId($entry)
    {
        /** @var \Wallee\Sdk\Model\PaymentMethod $entry */
        return $entry->getId();
    }
}