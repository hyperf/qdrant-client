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

use Hyperf\Stringable\Str;
use ReflectionClass;
use ReflectionParameter;

trait InstanceFromArray
{
    public static function fromArray(?array $attributes): ?static
    {
        if (! $attributes) {
            return null;
        }
        # 反射获取当前类的构造函数的参数
        $reflection = new ReflectionClass(static::class);
        $params = $reflection->getConstructor()->getParameters();

        # 从数组中获取当前类的构造函数的参数的值
        $values = array_map(function (ReflectionParameter $param) use ($attributes) {
            $attribute = null;
            # 小驼峰转下划线
            $name = (string) Str::of($param->getName())->snake();
            if (isset($attributes[$name]) || isset($attributes[$param->getName()])) {
                $attribute = $attributes[$name] ?? $attributes[$param->getName()];
            }

            if ($param->getType()) {
                # 如果是枚举类型，则调用枚举的tryFrom方法
                if (method_exists($param->getType()->getName(), 'tryFrom')) {
                    return $param->getType()->getName()::tryFrom($attribute);
                }
                # 如果类型有formArray方法，则调用该方法
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

        # 实例化当前类
        return new static(...$values);
    }
}
