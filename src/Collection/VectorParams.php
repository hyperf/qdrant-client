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

use Hyperf\Qdrant\Collection\Enums\Distance;

class VectorParams
{
    use InstanceFromArray;
    public function __construct(
        protected int $size,
        protected Distance $distance,
        protected ?HnswConfigDiff $hnswConfig,
        protected ?QuantizationConfig $quantizationConfig,
        protected ?bool $onDisk,
    ) {
    }
}
