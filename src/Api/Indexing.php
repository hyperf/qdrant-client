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

use Hyperf\Qdrant\Struct\PayloadSchemaType;
use Hyperf\Qdrant\Struct\UpdateResult;
use Hyperf\Qdrant\Struct\WriteOrdering;

class Indexing extends AbstractApi
{
    // TODO
    protected ?bool $wait = null;

    protected ?WriteOrdering $ordering = null;

    public function setWait(?bool $wait): Indexing
    {
        $this->wait = $wait;
        return $this;
    }

    public function setOrdering(?WriteOrdering $ordering): Indexing
    {
        $this->ordering = $ordering;
        return $this;
    }

    public function createIndex(
        string $collectionName,
        string $fieldName,
        ?PayloadSchemaType $payloadSchemaType = null
    ): UpdateResult {
        $params = [
            'field_name' => $fieldName,
            'field_schema' => $payloadSchemaType->value,
        ];
        $result = $this->request('PUT', "/collections/{$collectionName}/index", $params);
        return UpdateResult::fromArray($result);
    }

    public function deleteIndex(string $collectionName, string $fieldName): UpdateResult
    {
        $result = $this->request('DELETE', "/collections/{$collectionName}/index/{$fieldName}");
        return UpdateResult::fromArray($result);
    }

    protected function getQueryParams(): array
    {
        return [
            'wait' => $this->wait ? json_encode($this->wait) : null,
            'ordering' => $this->ordering,
        ];
    }
}
