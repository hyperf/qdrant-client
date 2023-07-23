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
namespace Hyperf\Qdrant\Struct;

enum PayloadSchemaType: string
{
    case KEYWORD = 'keyword';
    case INTEGER = 'integer';
    case FLOAT = 'float';
    case GEO = 'geo';
    case TEXT = 'text';
}
