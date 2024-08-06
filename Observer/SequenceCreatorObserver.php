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
use Magento\Store\Api\Data\StoreInterface;
use Opengento\SalesSequence\Service\SequenceManagement;

class SequenceCreatorObserver implements ObserverInterface
{
    public function __construct(private SequenceManagement $sequenceManagement) {}

    /**
     * @throws AlreadyExistsException
     */
    public function execute(EventObserver $observer): void
    {
        $store = $observer->getData('store');
        if ($store instanceof StoreInterface) {
            $this->sequenceManagement->create((int)$store->getId());
        }
    }
}
