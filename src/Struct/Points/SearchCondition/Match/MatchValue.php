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
namespace Hyperf\Qdrant\Struct\Points\SearchCondition\Match;

use Hyperf\Qdrant\Struct\InstanceFromArray;

class MatchValue implements MatchInterface
{
    use InstanceFromArray;

    public function __construct(public readonly string|int|bool $value)
    {
    }
}
