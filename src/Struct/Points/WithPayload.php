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
namespace Hyperf\Qdrant\Struct\Points;

use Hyperf\Qdrant\Struct\InstanceFromAttribute;

class WithPayload implements WithPayloadInterface
{
    use InstanceFromAttribute;

    public function __construct(public readonly bool|array $payload)
    {
    }

    public function getWithPayload(): mixed
    {
        return $this->payload;
    }
}
