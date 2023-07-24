<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace Hyperf\Qdrant\Struct\Collections;

use Hyperf\Qdrant\Struct\InstanceFromArray;

class OptimizersConfig
{
    use InstanceFromArray;

    public function __construct(
        public readonly float $deletedThreshold,
        public readonly int $vacuumMinVectorNumber,
        public readonly int $defaultSegmentNumber,
        public readonly int $flushIntervalSec,
        public readonly int $maxOptimizationThreads,
        public readonly ?int $maxSegmentSize,
        public readonly ?int $memmapThreshold,
        public readonly ?int $indexingThreshold,
    ) {
    }
}
