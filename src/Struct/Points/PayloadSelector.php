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

use Hyperf\Qdrant\Struct\InstanceFromArray;
use InvalidArgumentException;

class PayloadSelector implements WithPayloadInterface
{
    use InstanceFromArray;

    public function __construct(
        public readonly ?array $include = null,
        public readonly ?array $exclude = null,
    ) {
        if (! $this->include && ! $this->exclude) {
            throw new InvalidArgumentException('At least one of include or exclude must be set');
        }
    }

    public function getWithPayload(): mixed
    {
        return array_filter([
            'include' => $this->include,
            'exclude' => $this->exclude,
        ]);
    }
}
