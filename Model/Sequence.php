<?php
/**
 * Copyright © OpenGento, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace Opengento\SalesSequence\Model;

use Magento\Framework\App\ResourceConnection as AppResource;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\DB\Sequence\SequenceInterface;
use Magento\SalesSequence\Model\Meta;
use Magento\SalesSequence\Model\Profile;

class Sequence implements SequenceInterface
{
    private const DEFAULT_PATTERN  = '%1$s%4$s%2$\'.09d%3$s';

    private AdapterInterface $connection;
    private ?string $lastIncrementId = null;

    public function __construct(
        private Meta $meta,
        AppResource $resource,
        private string $pattern = self::DEFAULT_PATTERN
    ) {
        $this->connection = $resource->getConnection('sales');
    }

    public function getCurrentValue(): string
    {
        return $this->lastIncrementId === null ? '' : $this->formatValue($this->calculateCurrentValue());
    }

    public function getNextValue(): string
    {
        $sequenceTable = (string)$this->meta->getData('sequence_table');
        $this->connection->insert($sequenceTable, []);
        $this->lastIncrementId = $this->connection->lastInsertId($sequenceTable);

        return $this->getCurrentValue();
    }

    private function calculateCurrentValue(): int
    {
        /** @var Profile $activeProfile */
        $activeProfile = $this->meta->getData('active_profile');
        $startValue = (int)$activeProfile->getData('start_value');

        return ($this->lastIncrementId - $startValue) * $activeProfile->getData('step') + $startValue;
    }

    private function formatValue(int $value): string
    {
        /** @var Profile $activeProfile */
        $activeProfile = $this->meta->getData('active_profile');

        return sprintf(
            $this->pattern,
            $activeProfile->getData('prefix'),
            $value,
            $activeProfile->getData('suffix'),
            $this->meta->getData('store_id')
        );
    }
}
