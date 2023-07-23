<?php

namespace Hyperf\Qdrant\Struct\Aliases;

use Hyperf\Qdrant\Struct\InstanceFromArray;

class DeleteAliasOperation
{
    use InstanceFromArray;
    public function __construct(
        protected DeleteAlias $deleteAlias,
    ) {
    }
}