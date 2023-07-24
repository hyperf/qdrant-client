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
namespace Hyperf\Qdrant\Struct\Points\SearchCondition;

use Hyperf\Qdrant\Struct\InstanceFromArray;

class Filter implements ConditionInterface
{
    use InstanceFromArray;
    /**
     * @param list<ConditionInterface> $should
     * @param list<ConditionInterface> $must
     * @param list<ConditionInterface> $mustNot
     */
    public function __construct(
        public readonly ?array $should = null,
        public readonly ?array $must = null,
        public readonly ?array $mustNot = null,
    ) {
    }
}
