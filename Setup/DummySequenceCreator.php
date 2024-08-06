<?php
/**
 * Copyright © OpenGento, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace Opengento\SalesSequence\Setup;

use Magento\SalesSequence\Setup\SequenceCreator;

class DummySequenceCreator extends SequenceCreator
{
    public function create(): void {}
}
