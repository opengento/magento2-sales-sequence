<?php
/**
 * Copyright © OpenGento, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace Opengento\SalesSequence\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\SalesSequence\Model\Config as DefaultConfig;
use Magento\SalesSequence\Model\Sequence;
use Magento\Store\Model\ScopeInterface;

use function sprintf;

class Config
{
    private const CONFIG_PATH_PATTERN = 'sales_sequence/%s/pattern';
    private const CONFIG_PATH_PREFIX = 'sales_sequence/%s/prefix';
    private const CONFIG_PATH_SUFFIX = 'sales_sequence/%s/suffix';
    private const CONFIG_PATH_START_VALUE = 'sales_sequence/%s/start_value';
    private const CONFIG_PATH_STEP = 'sales_sequence/%s/step';
    private const CONFIG_PATH_WARNING_VALUE = 'sales_sequence/%s/warning_value';
    private const CONFIG_PATH_MAX_VALUE = 'sales_sequence/%s/max_value';

    public function __construct(
        private ScopeConfigInterface $scopeConfig,
        private DefaultConfig $defaultConfig
    ) {}

    public function getPattern(string $entityType, int $storeId): string
    {
        return $this->fetch(self::CONFIG_PATH_PATTERN, $entityType, $storeId) ?? Sequence::DEFAULT_PATTERN;
    }

    public function getPrefix(string $entityType, int|string|null $store = null): string
    {
        return $this->fetch(self::CONFIG_PATH_PREFIX, $entityType, $store) ?? $this->defaultConfig->get('prefix');
    }

    public function getSuffix(string $entityType, int|string|null $store = null): string
    {
        return $this->fetch(self::CONFIG_PATH_SUFFIX, $entityType, $store) ?? $this->defaultConfig->get('suffix');
    }

    public function getStartValue(string $entityType, int|string|null $store = null): int
    {
        return (int)($this->fetch(self::CONFIG_PATH_START_VALUE, $entityType, $store) ?? $this->defaultConfig->get('startValue'));
    }

    public function getStep(string $entityType, int|string|null $store = null): int
    {
        return (int)($this->fetch(self::CONFIG_PATH_STEP, $entityType, $store) ?? $this->defaultConfig->get('step'));
    }

    public function getWarningValue(string $entityType, int|string|null $store = null): int
    {
        return (int)($this->fetch(self::CONFIG_PATH_WARNING_VALUE, $entityType, $store) ?? $this->defaultConfig->get('warningValue'));
    }

    public function getMaxValue(string $entityType, int|string|null $store = null): int
    {
        return (int)($this->fetch(self::CONFIG_PATH_MAX_VALUE, $entityType, $store) ?? $this->defaultConfig->get('maxValue'));
    }

    private function fetch(string $path, string $entityType, int|string|null $store = null): ?string
    {
        return $this->scopeConfig->getValue(sprintf($path, $entityType), ScopeInterface::SCOPE_STORE, $store);
    }
}
