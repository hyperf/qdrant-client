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

class QuantizationSearchParams implements JsonSerializable
{
    use InstanceFromArray;

    public function __construct(
        public readonly bool $ignore = false,
        public readonly bool $rescore = false,
        public readonly ?float $oversampling = null,
    ) {
    }
}
