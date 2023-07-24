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
namespace Hyperf\Qdrant\Struct\Points;

use Hyperf\Qdrant\Struct\InstanceFromArray;
use JsonSerializable;

class SearchParams implements JsonSerializable
{
    use InstanceFromArray;

    public function __construct(
        public readonly ?int $hnswEf = null,
        public readonly ?bool $exact = false,
        public readonly ?QuantizationSearchParams $quantization = null,
    ) {
    }
}
