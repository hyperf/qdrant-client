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
namespace Hyperf\Qdrant;

class Config implements ConfigInterface
{
    public function getScheme(): string
    {
        return 'http';
    }

    public function getHost(): string
    {
        return '127.0.0.1';
    }

    public function getPort(): int
    {
        return 6333;
    }
}
