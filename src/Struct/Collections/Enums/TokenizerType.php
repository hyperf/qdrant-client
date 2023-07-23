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
namespace Hyperf\Qdrant\Struct\Collections\Enums;

enum TokenizerType: string
{
    case PREFIX = 'prefix';
    case WHITESPACE = 'whitespace';
    case WORD = 'word';
}
