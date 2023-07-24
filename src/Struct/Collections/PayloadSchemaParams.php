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

use Hyperf\Qdrant\Struct\Collections\Enums\TextIndexType;
use Hyperf\Qdrant\Struct\Collections\Enums\TokenizerType;

class PayloadSchemaParams
{
    public function __construct(
        public readonly TextIndexType $type,
        public readonly TokenizerType $tokenizer,
        public readonly ?int $minTokenLen,
        public readonly ?int $maxTokenLen,
        public readonly ?bool $lowercase = true,
    ) {
    }
}
