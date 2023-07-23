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

use Hyperf\Stringable\Str;
use ReflectionClass;
use ReflectionParameter;

trait InstanceFromArray
{
    public static function fromArray(?array $attributes): ?self
    {
        if (! $attributes) {
            return null;
        }
        $reflection = new ReflectionClass(static::class);
        $params = $reflection->getConstructor()->getParameters();

        $values = array_map(function (ReflectionParameter $param) use ($attributes) {
            $attribute = null;
            $name = (string) Str::of($param->getName())->snake();
            if (isset($attributes[$name]) || isset($attributes[$param->getName()])) {
                $attribute = $attributes[$name] ?? $attributes[$param->getName()];
            }

            if ($param->getType()) {
                if (method_exists($param->getType()->getName(), 'tryFrom')) {
                    return $param->getType()->getName()::tryFrom($attribute);
                }
                if (method_exists($param->getType()->getName(), 'fromArray')) {
                    return $param->getType()->getName()::fromArray($attribute);
                }
            }
            if (isset($attribute)) {
                return $attribute;
            }
            if ($param->isDefaultValueAvailable()) {
                return $param->getDefaultValue();
            }
            return null;
        }, $params);

        return new self(...$values);
    }

    public function toArray(): array
    {
        $result = [];
        foreach (get_object_vars($this) as $key => $value) {
            if (is_object($value) && method_exists($value, 'toArray')) {
                $value = $value->toArray();
            }
            $result[(string) Str::of($key)->snake()] = $value;
        }
        return $result;
    }
}
