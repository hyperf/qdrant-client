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
namespace HyperfTest\Qdrant\Cases;

use Hyperf\Qdrant\Api\Collections;
use Hyperf\Qdrant\Config;
use Hyperf\Qdrant\Connection\HttpClient;
use Hyperf\Qdrant\Struct\Collections\CollectionInfo;
use Hyperf\Qdrant\Struct\Collections\Enums\Distance;
use Hyperf\Qdrant\Struct\Collections\VectorParams;

/**
 * @internal
 * @coversNothing
 */
class CollectionsTest extends AbstractTestCase
{
    protected string $collectionName = 'testCollection';

    public function setUp(): void
    {
        $this->colections = new Collections(new HttpClient(new Config()));
    }

    public function testGetCollectionList()
    {
        $list = $this->colections->getListCollections();
        $this->assertIsArray($list);
    }

    public function testCreateCollection()
    {
        $result = $this->colections->createCollection(
            $this->collectionName,
            new VectorParams(128, Distance::COSINE),
        );
        $this->assertTrue($result);
    }

    public function testGetCollectionInfo()
    {
        $collectionInfo = $this->colections->getCollectionInfo($this->collectionName);
        $this->assertInstanceOf(CollectionInfo::class, $collectionInfo);
    }

    public function testUpdateCollection()
    {
        $result = $this->colections->updateCollection($this->collectionName);
        $this->assertTrue($result);
    }

    public function testDeleteCollection()
    {
        $result = $this->colections->deleteCollection($this->collectionName);
        $this->assertTrue($result);
    }
}
