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
        $storeCode = (string)$observer->getData('store');
        if ($storeCode !== '') {
            $this->sequenceManagement->update((int)$this->storeManager->getStore($storeCode)->getId());
        }
    }
}
