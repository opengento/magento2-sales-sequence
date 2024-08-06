<?php
/**
 * Copyright © OpenGento, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace Opengento\SalesSequence\Service;

use Magento\Framework\Exception\AlreadyExistsException;
use Magento\SalesSequence\Model\Builder;
use Magento\SalesSequence\Model\EntityPool;
use Opengento\SalesSequence\Model\Config;

class SequenceManagement
{
    public function __construct(
        private Builder $sequenceBuilder,
        private EntityPool $entityPool,
        private Config $config
    ) {}

    /**
     * @throws AlreadyExistsException
     */
    public function createOrUpdate(int $storeId): void
    {
        foreach ($this->entityPool->getEntities() as $entityType) {
            $this->sequenceBuilder
                ->setEntityType($entityType)
                ->setStoreId($storeId)
                ->setPrefix($this->config->getPrefix($entityType, $storeId))
                ->setSuffix($this->config->getSuffix($entityType, $storeId))
                ->setStartValue($this->config->getStartValue($entityType, $storeId))
                ->setStep($this->config->getStep($entityType, $storeId))
                ->setWarningValue($this->config->getWarningValue($entityType, $storeId))
                ->setMaxValue($this->config->getMaxValue($entityType, $storeId))
                ->create();
        }
    }
}
