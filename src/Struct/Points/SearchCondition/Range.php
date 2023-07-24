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
namespace Hyperf\Qdrant\Struct\Points\SearchCondition;

use Hyperf\Qdrant\Struct\InstanceFromArray;
use JsonSerializable;

class Range implements JsonSerializable
{
    use InstanceFromArray;

    public function __construct(
        public readonly ?float $lt = null,
        public readonly ?float $gt = null,
        public readonly ?float $lte = null,
        public readonly ?float $gte = null,
    ) {
    }
}
