<?php
/**
 * Copyright © OpenGento, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace Opengento\SalesSequence\Model;

use Magento\Framework\DB\Sequence\SequenceInterface;
use Magento\SalesSequence\Model\Manager;
use Magento\SalesSequence\Model\ResourceModel\Meta as MetaResource;

class SequenceManager extends Manager
{
    public function __construct(
        private Config $config,
        private MetaResource $metaResource,
        private SequenceFactory $sequenceFactory
    ) {}

    public function getSequence($entityType, $storeId): SequenceInterface
    {
        $storeId = (int)$storeId;
        $entityType = (string)$entityType;

        return  $this->sequenceFactory->create([
            'meta' => $this->metaResource->loadByEntityTypeAndStore($entityType, $storeId),
            'pattern' => $this->config->getPattern($entityType, $storeId)
        ]);
    }
}
