<?php
/**
 * Copyright © OpenGento, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace Opengento\SalesSequence\Service;

use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\LocalizedException;
use Magento\SalesSequence\Model\Builder;
use Magento\SalesSequence\Model\EntityPool;
use Magento\SalesSequence\Model\Meta;
use Magento\SalesSequence\Model\ResourceModel\Meta as MetaResource;
use Opengento\SalesSequence\Model\Config;

class SequenceManagement
{
    public function __construct(
        private EntityPool $entityPool,
        private Builder $sequenceBuilder,
        private MetaResource $metaResource,
        private Config $config
    ) {}

    /**
     * @throws AlreadyExistsException
     */
    public function create(int $storeId): void
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

    /**
     * @throws AlreadyExistsException
     * @throws LocalizedException
     */
    public function update(int $storeId): void
    {
        foreach ($this->entityPool->getEntities() as $entityType) {
            $meta = $this->metaResource->loadByEntityTypeAndStore($entityType, $storeId);
            if ($meta->getEntityId()) {
                $this->updateMeta($meta);
            } else {
                // Prevent case where sequence was deleted
                $this->create($storeId);
            }
        }
    }

    /**
     * @throws AlreadyExistsException
     */
    private function updateMeta(Meta $meta): void
    {
        $entityType = $meta->getData('entity_type');
        $storeId = $meta->getData('store_id');
        $meta->addData([
            'prefix' => $this->config->getPrefix($entityType, $storeId),
            'suffix' => $this->config->getSuffix($entityType, $storeId),
            'start_value' => $this->config->getStartValue($entityType, $storeId),
            'step' => $this->config->getStep($entityType, $storeId),
            'warning_value' => $this->config->getWarningValue($entityType, $storeId),
            'max_value' => $this->config->getMaxValue($entityType, $storeId)
        ]);
        $this->metaResource->save($meta);
    }
}
