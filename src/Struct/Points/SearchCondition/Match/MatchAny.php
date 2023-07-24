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

class MatchAny implements MatchInterface
{
    use InstanceFromArray;

    /**
     * @param list<int|string> $any
     */
    public function __construct(public readonly array $any)
    {
    }
}
