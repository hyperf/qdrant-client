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
namespace Hyperf\Qdrant\Collection;

use Hyperf\Contract\Arrayable;
use Hyperf\Qdrant\Collection\Enums\CollectionStatus;
use Hyperf\Qdrant\Collection\Enums\OptimizersStatus;

class CollectionInfo implements Arrayable
{
    use InstanceFromArray;

    public function __construct(
        protected string $name,
        protected CollectionStatus $status,
        protected OptimizersStatus $optimizerStatus,
        protected int $vectorsCount,
        protected int $indexedVectorsCount,
        protected int $pointsCount,
        protected int $segmentsCount,
        protected CollectionConfig $config,
        protected array $payloadSchema,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function toArray(): array
    {
        return array_map(function ($value) {
            return $value instanceof Arrayable ? $value->toArray() : $value;
        }, get_object_vars($this));
    }
}
