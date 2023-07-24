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

use Hyperf\Qdrant\Struct\Collections\Enums\Distance;
use Hyperf\Qdrant\Struct\InstanceFromArray;

class VectorParams
{
    use InstanceFromArray;

    public function __construct(
        public readonly int $size,
        public readonly Distance $distance,
        public readonly ?HnswConfigDiff $hnswConfig = null,
        public readonly ?QuantizationConfig $quantizationConfig = null,
        public readonly ?bool $onDisk = false,
    ) {
    }
}
