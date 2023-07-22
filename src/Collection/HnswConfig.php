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
namespace Hyperf\Qdrant\Collection;

class HnswConfig
{
    use InstanceFromArray;
    public function __construct(
        protected int $m,
        protected int $efConstruct,
        protected int $fullScanThreshold,
        protected int $maxIndexingThreads = 0,
        protected ?bool $onDisk = null,
        protected ?int $payloadM = null,
    ) {
    }

}
