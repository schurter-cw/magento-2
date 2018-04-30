<?php
/**
 * Wallee Magento 2
 *
 * This Magento 2 extension enables to process payments with Wallee (https://www.wallee.com/).
 *
 * @package Wallee_Payment
 * @author customweb GmbH (http://www.customweb.com/)
 * @license http://www.apache.org/licenses/LICENSE-2.0  Apache Software License (ASL 2.0)
 */
namespace Wallee\Payment\Api;

/**
 * Payment method configuration management interface.
 *
 * @api
 */
interface PaymentMethodConfigurationManagementInterface
{

    /**
     * Synchronizes the payment method configurations from wallee.
     */
    public function synchronize();

    /**
     * Updates the payment method configuration information.
     *
     * @param \Wallee\Sdk\Model\PaymentMethodConfiguration $configuration
     */
    public function update(\Wallee\Sdk\Model\PaymentMethodConfiguration $configuration);
}