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

use Hyperf\Qdrant\Struct\Points\ExtendedPointId;
use Hyperf\Qdrant\Struct\Points\ExtendedPointIds;
use Hyperf\Qdrant\Struct\Points\Point\ScoredPoint;
use Hyperf\Qdrant\Struct\Points\ReadConsistencyType;
use Hyperf\Qdrant\Struct\Points\Record;
use Hyperf\Qdrant\Struct\Points\SearchCondition\Filter;
use Hyperf\Qdrant\Struct\Points\SearchParams;
use Hyperf\Qdrant\Struct\Points\VectorStruct;
use Hyperf\Qdrant\Struct\Points\WithPayloadInterface;
use Hyperf\Qdrant\Struct\Points\WithVector;
use Hyperf\Qdrant\Struct\UpdateResult;
use Hyperf\Qdrant\Struct\WriteOrdering;

class Points extends AbstractApi
{
    // TODO
    protected ?bool $wait = null;

    protected ?WriteOrdering $ordering = null;

    protected int|ReadConsistencyType|null $consistency = null;

    public function setWait(?bool $wait): Points
    {
        $this->wait = $wait;
        return $this;
    }

    public function getPoint(string $collectionName, ExtendedPointId $pointId): Record
    {
        $result = $this->request('GET', "/collections/{$collectionName}/points/{$pointId}");
        return Record::fromArray($result);
    }

    /**
     * @return Record[]
     */
    public function getPoints(
        string $collectionName,
        ExtendedPointIds $pointIds,
        ?WithPayloadInterface $withPayload = null,
        ?WithVector $withVector = null,
    ): array {
        $params = [
            'ids' => $pointIds,
            'with_payload' => $withPayload->getWithPayload(),
            'with_vector' => $withVector,
        ];
        $result = $this->request('POST', "/collections/{$collectionName}/points", $params);
        return array_map(fn (array $item) => Record::fromArray($item), $result);
    }

    /**
     * @param Record[] $records
     */
    public function upsertPoints(
        string $collectionName,
        array $records,
    ): UpdateResult {
        $params = [
            'points' => array_map(fn (Record $record) => $record->toArray(), $records),
        ];
        $result = $this->request('PUT', "/collections/{$collectionName}/points", $params);

        return UpdateResult::fromArray($result);
    }

    public function deletePoints(string $collectionName, ExtendedPointIds $pointIds): UpdateResult
    {
        $result = $this->request('POST', "/collections/{$collectionName}/points/delete", ['points' => $pointIds]);
        return UpdateResult::fromArray($result);
    }

    /**
     * @return ScoredPoint[]
     */
    public function searchPoints(
        string $collectionName,
        VectorStruct $vector,
        int $limit = 5,
        ?Filter $filter = null,
        ?SearchParams $params = null,
        ?int $offset = 0,
        ?WithPayloadInterface $withPayload = null,
        ?WithVector $withVector = null,
        ?float $scoreThreshold = null,
    ): array {
        $params = [
            'vector' => $vector,
            'filter' => $filter,
            'limit' => $limit,
            'params' => $params,
            'offset' => $offset,
            'with_payload' => $withPayload?->getWithPayload(),
            'with_vector' => $withVector,
            'score_threshold' => $scoreThreshold,
        ];
        $result = $this->request('POST', "/collections/{$collectionName}/points/search", $params);
        return array_map(fn (array $item) => ScoredPoint::fromArray($item), $result);

    }

    protected function getQueryParams(): array
    {
        return [
            'consistency' => $this->consistency,
            'wait' => $this->wait ? json_encode($this->wait) : null,
            'ordering' => $this->ordering,
        ];
    }
}
