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
use Hyperf\Qdrant\Api\Indexing;
use Hyperf\Qdrant\Config;
use Hyperf\Qdrant\Connection\HttpClient;
use Hyperf\Qdrant\Struct\Collections\Enums\Distance;
use Hyperf\Qdrant\Struct\Collections\VectorParams;
use Hyperf\Qdrant\Struct\PayloadSchemaType;
use Hyperf\Qdrant\Struct\UpdateResult;
use Hyperf\Qdrant\Struct\UpdateStatus;

/**
 * @internal
 * @coversNothing
 */
class IndexingTest extends AbstractTestCase
{
    protected string $collectionName = 'testCollection';

    public function setUp(): void
    {
        $client = new HttpClient(new Config());
        $this->colections = new Collections($client);
        $this->colections->createCollection($this->collectionName, new VectorParams(128, Distance::COSINE));
        $this->indexing = new Indexing($client);
    }

    public function tearDown(): void
    {
        $this->colections->deleteCollection($this->collectionName);
    }

    public function testCreateIndex()
    {
        $this->indexing->setWait(true);
        $result = $this->indexing->createIndex($this->collectionName, 'testField', PayloadSchemaType::TEXT);
        $this->assertInstanceOf(UpdateResult::class, $result);
        $this->assertEquals(UpdateStatus::COMPLETED, $result->getStatus());
    }

    public function testDeleteIndex()
    {
        $result = $this->indexing->deleteIndex($this->collectionName, 'testField');
        $this->assertInstanceOf(UpdateResult::class, $result);
    }
}
