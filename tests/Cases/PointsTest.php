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
use Hyperf\Qdrant\Api\Points;
use Hyperf\Qdrant\Config;
use Hyperf\Qdrant\Connection\HttpClient;
use Hyperf\Qdrant\Struct\Collections\Enums\Distance;
use Hyperf\Qdrant\Struct\Collections\VectorParams;
use Hyperf\Qdrant\Struct\Points\ExtendedPointId;
use Hyperf\Qdrant\Struct\Points\ExtendedPointIds;
use Hyperf\Qdrant\Struct\Points\PayloadSelector;
use Hyperf\Qdrant\Struct\Points\Point\PointStruct;
use Hyperf\Qdrant\Struct\Points\Point\Record;
use Hyperf\Qdrant\Struct\Points\SearchCondition\FieldCondition;
use Hyperf\Qdrant\Struct\Points\SearchCondition\Filter;
use Hyperf\Qdrant\Struct\Points\SearchCondition\Match\MatchValue;
use Hyperf\Qdrant\Struct\Points\VectorStruct;
use Hyperf\Qdrant\Struct\Points\WithPayload;
use Hyperf\Qdrant\Struct\Points\WithVector;
use Hyperf\Qdrant\Struct\UpdateResult;

/**
 * @internal
 * @coversNothing
 */
class PointsTest extends AbstractTestCase
{
    protected static string $collectionName = 'testCollection';

    protected static Collections $colections;

    protected static Points $points;

    public static function setUpBeforeClass(): void
    {
        $client = new HttpClient(new Config());
        self::$colections = new Collections($client);
        self::$colections->createCollection(self::$collectionName, new VectorParams(128, Distance::COSINE));
        self::$points = new Points($client);
    }

    public static function tearDownAfterClass(): void
    {
        self::$colections->deleteCollection(self::$collectionName);
    }

    public function testUpsertPoints()
    {
        $pointStructs = [
            new PointStruct(new ExtendedPointId(1), new VectorStruct(array_fill(0, 128, 1)), ['name' => 'test1', 'age' => 18]),
            new PointStruct(new ExtendedPointId(2), new VectorStruct(array_fill(0, 128, 1)), ['name' => 'test2', 'age' => 19]),
        ];
        self::$points->setWait(true);
        $result = self::$points->upsertPoints(self::$collectionName, $pointStructs);

        $this->assertInstanceOf(UpdateResult::class, $result);
    }

    public function testSearchPoints()
    {
        $records = self::$points->searchPoints(
            self::$collectionName,
            new VectorStruct(array_fill(0, 128, 1)),
            5,
            new Filter(
                must: [
                    new FieldCondition('name', new MatchValue('test2')),
                ],
            ),
            withVector: new WithVector(false),
        );
        $this->assertEquals(2, $records[0]->id->id);
    }

    public function testGetPoint()
    {
        $record = self::$points->getPoint(self::$collectionName, new ExtendedPointId(1));
        $this->assertInstanceOf(Record::class, $record);
        $this->assertEquals(1, $record->id->id);
    }

    public function testGetPoints()
    {
        $record = self::$points->getPoints(
            self::$collectionName,
            new ExtendedPointIds([1, 2, 3]),
            new WithPayload(true),
            new WithVector(true),
        );
        $this->assertIsArray($record);
        $this->assertInstanceOf(Record::class, $record[0]);
        $this->assertCount(2, $record);

        $record = self::$points->getPoints(
            self::$collectionName,
            new ExtendedPointIds([1, 2, 3]),
            new PayloadSelector(include: ['name']),
            new WithVector(false),
        );
        $this->assertArrayNotHasKey('age', $record[0]->payload);
        $this->assertNull($record[0]->vector->vector);

        $record = self::$points->getPoints(
            self::$collectionName,
            new ExtendedPointIds([1, 2, 3]),
            new PayloadSelector(exclude: ['name']),
            new WithVector(false),
        );
        $this->assertArrayNotHasKey('name', $record[0]->payload);
    }

    public function testDeletePoints()
    {
        $result = self::$points->deletePoints(self::$collectionName, new ExtendedPointIds([2]));
        $this->assertInstanceOf(UpdateResult::class, $result);
    }

    public function testUpdatePoints()
    {
        $payload = [
            'name' => 'test1',
            'age' => 18,
        ];
        $pointStructs = [
            new PointStruct(new ExtendedPointId(1), new VectorStruct(array_fill(0, 128, 1)), $payload),
        ];
        self::$points->setWait(true);
        self::$points->upsertPoints(self::$collectionName, $pointStructs);

        $record = self::$points->getPoint(self::$collectionName, new ExtendedPointId(1));
        $this->assertEquals($payload, $record->payload);
    }
}
