<?php

namespace Hyperf\Qdrant\Struct\Points\Point;

use Hyperf\Qdrant\Struct\InstanceFromArray;
use Hyperf\Qdrant\Struct\Points\ExtendedPointId;
use Hyperf\Qdrant\Struct\Points\VectorStruct;

class Record
{
    use InstanceFromArray;
    public function __construct(
        public readonly ExtendedPointId $id,
        public readonly ?VectorStruct $vector = null,
        public readonly ?array $payload = null,
    ) {
    }
}