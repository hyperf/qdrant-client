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

use Hyperf\Qdrant\Collection\CollectionInfo;
use Hyperf\Qdrant\Collection\CollectionStatus;
use Hyperf\Qdrant\Config;
use Hyperf\Qdrant\Connection\HttpClient;
use Hyperf\Qdrant\Qdrant;

/**
 * @internal
 * @coversNothing
 */
class QdrantTest extends AbstractTestCase
{
    public function setUp(): void
    {
        $this->qdrant = new Qdrant(new HttpClient(new Config()));
    }

    public function testGetCollectionList()
    {
        $list = $this->qdrant->listCollections();
        $this->assertIsArray($list);
    }

    public function testGetCollectionInfo()
    {
        $collectionInfo = $this->qdrant->collectionInfo('my_documents');
        $this->assertInstanceOf(CollectionInfo::class, $collectionInfo);
    }
}
