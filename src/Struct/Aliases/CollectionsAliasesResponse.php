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
namespace Hyperf\Qdrant\Struct\Aliases;

use Hyperf\Qdrant\Struct\InstanceFromArray;

class CollectionsAliasesResponse
{
    use InstanceFromArray;

    /**
     * @param AliasDescription[] $aliases
     */
    public function __construct(
        protected array $aliases,
    ) {
    }

    public static function fromArray(?array $attributes): ?self
    {
        $aliases = array_map(
            fn (array $alias) => AliasDescription::fromArray($alias),
            $attributes['aliases'] ?? []
        );
        return new self($aliases);
    }

    public function toArray(): array
    {
        return [
            'aliases' => array_map(
                fn (AliasDescription $alias) => $alias->toArray(),
                $this->aliases
            ),
        ];
    }
}
