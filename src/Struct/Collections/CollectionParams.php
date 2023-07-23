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
namespace Hyperf\Qdrant\Struct\Collections;

use Hyperf\Qdrant\Struct\InstanceFromArray;

class CollectionParams
{
    use InstanceFromArray;

    public function __construct(
        protected VectorParams $vectors,
        protected ?int $shardNumber,
        protected ?int $replicationFactor,
        protected ?int $writeConsistencyFactor,
        protected bool $onDiskPayload,
    ) {
    }
}
