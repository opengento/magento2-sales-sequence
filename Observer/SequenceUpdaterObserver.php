<?php
/**
 * Copyright © OpenGento, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace Opengento\SalesSequence\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\StoreManagerInterface;
use Opengento\SalesSequence\Service\SequenceManagement;

use function array_keys;

class SequenceUpdaterObserver implements ObserverInterface
{
    public function __construct(
        private StoreManagerInterface $storeManager,
        private SequenceManagement $sequenceManagement
    ) {}

    /**
     * @throws NoSuchEntityException
     * @throws AlreadyExistsException
     * @throws LocalizedException
     */
    public function execute(EventObserver $observer): void
    {
        
        $store = $observer->getData('store');
        $website = $observer->getData('website');
        $stores = match (true) {
            $store !== null => [$this->storeManager->getStore($store)->getId()],
            $website !== null => $this->storeManager->getWebsite($website)->getStoreIds(),
            default => array_keys($this->storeManager->getStores())
        };
        foreach ($stores as $storeId) {
            $this->sequenceManagement->createOrUpdate((int)$storeId);
        }
    }
}
