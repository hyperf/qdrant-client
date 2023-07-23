<?php

namespace Hyperf\Qdrant\Struct\Collections;

use Hyperf\Qdrant\Struct\PayloadSchemaType;

class PayloadIndexInfo
{
    public function __construct(
        protected PayloadSchemaType $payloadSchemaType,
        protected int $points,
        protected ?PayloadSchemaParams $payloadSchemaParams,
    )
    {
    }
}