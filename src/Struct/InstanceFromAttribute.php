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

trait InstanceFromAttribute
{
    public function __toString(): string
    {
        $vars = get_object_vars($this);
        $attribute = array_shift($vars);
        return is_string($attribute) ? $attribute : json_encode($attribute);
    }

    public function jsonSerialize(): mixed
    {
        $vars = get_object_vars($this);
        return array_shift($vars);
    }

    public static function fromArray(mixed $attribute): ?self
    {
        return new self($attribute ?? null);
    }
}
