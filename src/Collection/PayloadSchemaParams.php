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

use Hyperf\Qdrant\Collection\Enums\TextIndexType;
use Hyperf\Qdrant\Collection\Enums\TokenizerType;

class PayloadSchemaParams
{
    public function __construct(
        protected TextIndexType $type,
        protected TokenizerType $tokenizer,
        protected ?int $minTokenLen,
        protected ?int $maxTokenLen,
        protected ?bool $lowercase = true,
    ) {
    }
}
