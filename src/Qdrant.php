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

use Hyperf\Qdrant\Collection\CollectionInfo;
use Hyperf\Qdrant\Connection\ClientInterface;

class Qdrant
{
    public function __construct(protected ClientInterface $client)
    {
    }

    public function listCollections(): array
    {
        $result = $this->client->request('GET', '/collections');
        return $result['collections'];
    }

    public function collectionInfo(string $name): CollectionInfo
    {
        $result = $this->client->request('GET', "/collections/{$name}");

        return CollectionInfo::fromArray($result + ['name' => $name]);
    }

    public function createCollection(string $name, string $initFrom = null): bool
    {
        $name = $collection->getName();
        $params = $collection->getConfig()->toArray();
        $params += [
            'shard_number' => null,
            'replication_factor' => null,
            'write_consistency_factor' => null,
            'on_disk_payload' => null,
            'init_from' => $initFrom ? ['collection' => $initFrom] : null,
        ];
        return $this->client->request('PUT', "/collections/{$name}", $params);
    }
}
