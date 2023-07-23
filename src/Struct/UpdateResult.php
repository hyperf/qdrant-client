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
namespace Hyperf\Qdrant\Struct;

class UpdateResult
{
    use InstanceFromArray;

    public function __construct(
        protected int $operationId,
        protected UpdateStatus $status,
    ) {
    }

    public function getOperationId(): int
    {
        return $this->operationId;
    }

    public function getStatus(): UpdateStatus
    {
        return $this->status;
    }
}