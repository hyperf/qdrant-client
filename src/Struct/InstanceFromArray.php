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
use ReflectionNamedType;
use ReflectionParameter;

trait InstanceFromArray
{
    /**
     * @param null|array<string, mixed> $attributes
     */
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

            if (($type = $param->getType()) && $type instanceof ReflectionNamedType) {
                if (method_exists($type->getName(), 'tryFrom')) {
                    return $type->getName()::tryFrom($attribute);
                }
                if (method_exists($type->getName(), 'fromArray')) {
                    return $type->getName()::fromArray($attribute);
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

    /**
     * @return array<string, mixed>
     */
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

    public function jsonSerialize(): mixed
    {
        $result = [];
        foreach (get_object_vars($this) as $key => $value) {
            $result[(string) Str::of($key)->snake()] = $value;
        }
        return $result;
    }
}
