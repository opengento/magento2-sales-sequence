<?php
/**
 * Copyright © OpenGento, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace Opengento\SalesSequence\Setup;

use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Store\Api\StoreRepositoryInterface;
use Opengento\SalesSequence\Service\SequenceManagement;

class RecurringData implements InstallDataInterface
{
    public function __construct(
        private StoreRepositoryInterface $storeRepository,
        private SequenceManagement $sequenceManagement
    ) {}

    /**
     * @throws AlreadyExistsException
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context): void
    {
        foreach ($this->storeRepository->getList() as $store) {
            $this->sequenceManagement->create((int)$store->getId());
        }
    }
}
