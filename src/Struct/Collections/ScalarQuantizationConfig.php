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

class ScalarQuantizationConfig
{
    use InstanceFromArray;
    public function __construct(
        protected string $type = 'int8',
        protected ?float $quantile = null,
        protected ?bool $alwaysRam = null,
    ) {
    }
}
