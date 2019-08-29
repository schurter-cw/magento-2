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
namespace Wallee\Payment\Model\Webhook\Listener;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\ResourceConnection;
use Magento\Sales\Model\OrderFactory;
use Magento\Sales\Model\ResourceModel\Order as OrderResourceModel;
use Psr\Log\LoggerInterface;
use Wallee\Payment\Api\TransactionInfoManagementInterface;
use Wallee\Payment\Api\TransactionInfoRepositoryInterface;
use Wallee\Payment\Model\ApiClient;
use Wallee\Payment\Model\Webhook\Request;
use Wallee\Sdk\Service\DeliveryIndicationService;

/**
 * Webhook listener to handle delivery indications.
 */
class DeliveryIndicationListener extends AbstractOrderRelatedListener
{

    /**
     *
     * @var ApiClient
     */
    private $apiClient;

    /**
     *
     * @param ResourceConnection $resource
     * @param LoggerInterface $logger
     * @param OrderFactory $orderFactory
     * @param OrderResourceModel $orderResourceModel
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param CommandPoolInterface $commandPool
     * @param TransactionInfoRepositoryInterface $transactionInfoRepository
     * @param TransactionInfoManagementInterface $transactionInfoManagement
     * @param ApiClient $apiClient
     */
    public function __construct(ResourceConnection $resource, LoggerInterface $logger, OrderFactory $orderFactory,
        OrderResourceModel $orderResourceModel, SearchCriteriaBuilder $searchCriteriaBuilder,
        CommandPoolInterface $commandPool, TransactionInfoRepositoryInterface $transactionInfoRepository,
        TransactionInfoManagementInterface $transactionInfoManagement, ApiClient $apiClient)
    {
        parent::__construct($resource, $logger, $orderFactory, $orderResourceModel, $searchCriteriaBuilder, $commandPool,
            $transactionInfoRepository, $transactionInfoManagement);
        $this->apiClient = $apiClient;
    }

    /**
     * Loads the delivery indication for the webhook request.
     *
     * @param Request $request
     * @return \Wallee\Sdk\Model\DeliveryIndication
     */
    protected function loadEntity(Request $request)
    {
        return $this->apiClient->getService(DeliveryIndicationService::class)->read($request->getSpaceId(),
            $request->getEntityId());
    }

    /**
     * Gets the transaction's ID.
     *
     * @param \Wallee\Sdk\Model\DeliveryIndication $entity
     * @return int
     */
    protected function getTransactionId($entity)
    {
        return $entity->getLinkedTransaction();
    }
}