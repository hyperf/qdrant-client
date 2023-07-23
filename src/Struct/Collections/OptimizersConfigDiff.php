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

class OptimizersConfigDiff
{
    use InstanceFromArray;

    public function __construct(
        protected ?float $deletedThreshold,
        protected ?int $vacuumMinVectorNumber,
        protected ?int $defaultSegmentNumber,
        protected ?int $flushIntervalSec,
        protected ?int $maxOptimizationThreads,
        protected ?int $maxSegmentSize,
        protected ?int $memmapThreshold,
        protected ?int $indexingThreshold,
    ) {
    }
}
