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

use Hyperf\Qdrant\Struct\Collections\Enums\CollectionStatus;
use Hyperf\Qdrant\Struct\Collections\Enums\OptimizersStatus;
use Hyperf\Qdrant\Struct\InstanceFromArray;

class CollectionInfo
{
    use InstanceFromArray;

    public function __construct(
        public readonly string $name,
        public readonly CollectionStatus $status,
        public readonly OptimizersStatus $optimizerStatus,
        public readonly ?int $vectorsCount,
        public readonly int $indexedVectorsCount,
        public readonly int $pointsCount,
        public readonly int $segmentsCount,
        public readonly CollectionConfig $config,
        public readonly array $payloadSchema,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }
}
