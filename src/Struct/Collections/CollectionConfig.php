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

class CollectionConfig
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
}
