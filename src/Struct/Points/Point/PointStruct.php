<?php

namespace Hyperf\Qdrant\Struct\Points\Point;

use Hyperf\Qdrant\Struct\InstanceFromArray;
use Hyperf\Qdrant\Struct\Points\ExtendedPointId;
use Hyperf\Qdrant\Struct\Points\VectorStruct;

class PointStruct
{
    use InstanceFromArray;
    public function __construct(
        public readonly ExtendedPointId $id,
        public readonly VectorStruct $vector,
        public readonly array $payload,
    ) {
    }
}