<?php

namespace Hyperf\Qdrant\Struct\Collections;

use Hyperf\Qdrant\Struct\InstanceFromArray;

class InitFrom
{
    use InstanceFromArray;
    public function __construct(
        protected string $collection,
    ) {
    }
}