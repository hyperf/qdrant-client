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
use Hyperf\Qdrant\Struct\Points\SearchCondition\Match\MatchInterface;

class FieldCondition implements ConditionInterface
{
    use InstanceFromArray;

    public function __construct(
        public readonly string $key,
        public readonly ?MatchInterface $match = null,
        public readonly ?Range $range = null,
        public readonly ?GeoBoundingBox $geoBoundingBox = null,
        public readonly ?GeoRadius $geoRadius = null,
        public readonly ?ValuesCount $valuesCount = null,
    ) {
    }
}
