<?php

namespace Hyperf\Qdrant\Collection;

use Hyperf\Qdrant\Collection\Enums\PayloadSchemaType;

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