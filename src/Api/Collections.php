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

use Hyperf\Qdrant\Struct\Collections\CollectionInfo;
use Hyperf\Qdrant\Struct\Collections\CollectionParamsDiff;
use Hyperf\Qdrant\Struct\Collections\HnswConfigDiff;
use Hyperf\Qdrant\Struct\Collections\InitFrom;
use Hyperf\Qdrant\Struct\Collections\OptimizersConfigDiff;
use Hyperf\Qdrant\Struct\Collections\QuantizationConfig;
use Hyperf\Qdrant\Struct\Collections\VectorParams;
use Hyperf\Qdrant\Struct\Collections\WalConfigDiff;

class Collections extends AbstractApi
{
    public function getListCollections(): array
    {
        $result = $this->client->request('GET', '/collections');
        return $result['collections'];
    }

    public function getCollectionInfo(string $name): CollectionInfo
    {
        $result = $this->client->request('GET', "/collections/{$name}");

        return CollectionInfo::fromArray($result + ['name' => $name]);
    }

    public function createCollection(
        string $name,
        VectorParams $vectorParams,
        ?int $shardNumber = null,
        ?int $replicationFactor = null,
        ?int $writeConsistencyFactor = null,
        ?bool $onDiskPayload = null,
        ?HnswConfigDiff $hnswConfigDiff = null,
        ?WalConfigDiff $walConfig = null,
        ?OptimizersConfigDiff $optimizersConfig = null,
        ?InitFrom $initFrom = null,
        ?QuantizationConfig $quantizationConfig = null,
    ): bool {
        $params = [
            'vectors' => $vectorParams->toArray(),
            'shard_number' => $shardNumber,
            'replication_factor' => $replicationFactor,
            'write_consistency_factor' => $writeConsistencyFactor,
            'on_disk_payload' => $onDiskPayload,
            'hnsw_config' => $hnswConfigDiff?->toArray(),
            'wal_config' => $walConfig?->toArray(),
            'optimizers_config' => $optimizersConfig?->toArray(),
            'init_from' => $initFrom?->toArray(),
            'quantization_config' => $quantizationConfig,
        ];
        return $this->client->request('PUT', "/collections/{$name}", $params);
    }

    public function deleteCollection(string $name): bool
    {
        return $this->client->request('DELETE', "/collections/{$name}");
    }

    public function updateCollection(
        string $name,
        ?OptimizersConfigDiff $configDiff = null,
        ?CollectionParamsDiff $paramsDiff = null,
    ): bool {
        $params = [
            'optimizers_config' => $configDiff?->toArray(),
            'params' => $paramsDiff?->toArray(),
        ];
        return $this->client->request('PATCH', "/collections/{$name}", $params);
    }
}
