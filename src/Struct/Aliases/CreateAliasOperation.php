<?php

namespace Hyperf\Qdrant\Struct\Aliases;

use Hyperf\Qdrant\Struct\InstanceFromArray;

class CreateAliasOperation
{
    use InstanceFromArray;
    public function __construct(
        public CreateAlias $createAlias,
    ) {
    }
}