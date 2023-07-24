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
namespace Hyperf\Qdrant\Struct\Points\Point;

use Hyperf\Qdrant\Struct\InstanceFromArray;
use Hyperf\Qdrant\Struct\Points\ExtendedPointId;
use Hyperf\Qdrant\Struct\Points\VectorStruct;

class ScoredPoint
{
    use InstanceFromArray;

    public function __construct(
        public readonly ExtendedPointId $id,
        public readonly int $version,
        public readonly float $score,
        public readonly ?array $payload = null,
        public readonly ?VectorStruct $vector = null,
    ) {
    }
}
