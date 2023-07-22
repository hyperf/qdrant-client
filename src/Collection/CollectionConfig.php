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

class CollectionConfig implements Arrayable
{
    use InstanceFromArray;

    public function __construct(
        protected CollectionParams $params,
        protected HnswConfig $hnswConfig,
        protected OptimizersConfig $optimizerConfig,
        protected WalConfig $walConfig,
        protected ?QuantizationConfig $quantizationConfig,
    ) {
    }

    public function toArray(): array
    {
        return array_map(function ($value) {
            return $value instanceof Arrayable ? $value->toArray() : $value;
        }, get_object_vars($this));
    }
}
