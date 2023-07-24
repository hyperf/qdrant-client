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

class HnswConfig
{
    use InstanceFromArray;

    public function __construct(
        public readonly int $m,
        public readonly int $efConstruct,
        public readonly int $fullScanThreshold,
        public readonly int $maxIndexingThreads = 0,
        public readonly ?bool $onDisk = null,
        public readonly ?int $payloadM = null,
    ) {
    }
}
