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
namespace Hyperf\Qdrant\Api;

use Hyperf\Qdrant\Struct\Aliases\CollectionsAliasesResponse;
use Hyperf\Qdrant\Struct\Aliases\CreateAliasOperation;
use Hyperf\Qdrant\Struct\Aliases\DeleteAliasOperation;
use Hyperf\Qdrant\Struct\Aliases\RenameAliasOperation;

class Aliases extends AbstractApi
{
    public function getAllAliases(): CollectionsAliasesResponse
    {
        $result = $this->request('GET', '/aliases');
        return CollectionsAliasesResponse::fromArray($result);
    }

    public function getListAliases(string $collectionName): CollectionsAliasesResponse
    {
        $result = $this->request('GET', "/collections/{$collectionName}/aliases");
        return CollectionsAliasesResponse::fromArray($result);
    }

    /**
     * @param list<CreateAliasOperation|DeleteAliasOperation|RenameAliasOperation> $actions
     */
    public function updateAliases(array $actions): bool
    {
        $params = array_map(fn ($action) => $action->toArray(), $actions);

        return $this->request('POST', '/collections/aliases', ['actions' => $params]);
    }
}
