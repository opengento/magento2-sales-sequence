<?php
/**
 * Copyright © OpenGento, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace Opengento\SalesSequence\Model;

use Magento\SalesSequence\Model\Manager;
use Magento\SalesSequence\Model\ResourceModel\Meta as MetaResource;
use Magento\SalesSequence\Model\Sequence;
use Magento\SalesSequence\Model\SequenceFactory;

class SequenceManager extends Manager
{
    public function __construct(
        private MetaResource $metaResource,
        private SequenceFactory $factory,
        private Config $config
    ) {}

    public function getSequence($entityType, $storeId): Sequence
    {
        return $this->factory->create(
            [
                'meta' => $this->metaResource->loadByEntityTypeAndStore(
                    (string)$entityType,
                    (int)$storeId
                ),
                'pattern' => $this->config->getPattern($entityType, $storeId)
            ]
        );
    }
}
