<?php

namespace Hyperf\Qdrant\Struct\Points;

use Hyperf\Qdrant\Struct\InstanceFromArray;

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