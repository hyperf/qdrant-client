<?php

namespace Hyperf\Qdrant\Struct\Aliases;

use Hyperf\Qdrant\Struct\InstanceFromArray;

class RenameAliasOperation
{
    use InstanceFromArray;
    public function __construct(
        public RenameAlias $renameAlias,
    ) {
    }
}