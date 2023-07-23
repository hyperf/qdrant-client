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

use Hyperf\Qdrant\Api\Aliases;
use Hyperf\Qdrant\Api\Collections;
use Hyperf\Qdrant\Config;
use Hyperf\Qdrant\Connection\HttpClient;
use Hyperf\Qdrant\Struct\Aliases\CollectionsAliasesResponse;
use Hyperf\Qdrant\Struct\Aliases\CreateAliasOperation;
use Hyperf\Qdrant\Struct\Aliases\DeleteAliasOperation;
use Hyperf\Qdrant\Struct\Aliases\RenameAliasOperation;
use Hyperf\Qdrant\Struct\Collections\Enums\Distance;
use Hyperf\Qdrant\Struct\Collections\VectorParams;

/**
 * @internal
 * @coversNothing
 */
class AliasesTest extends AbstractTestCase
{
    protected string $collectionName = 'testCollection';

    public function setUp(): void
    {
        $client = new HttpClient(new Config());
        $this->colections = new Collections($client);
        $this->colections->createCollection($this->collectionName, new VectorParams(128, Distance::COSINE));
        $this->aliases = new Aliases($client);
    }

    public function tearDown(): void
    {
        $this->colections->deleteCollection($this->collectionName);
    }

    public function testGetAllAliases()
    {
        $list = $this->aliases->getAllAliases();
        $this->assertInstanceOf(CollectionsAliasesResponse::class, $list);
    }

    public function testGetListAliases()
    {
        $list = $this->aliases->getListAliases($this->collectionName);
        $this->assertInstanceOf(CollectionsAliasesResponse::class, $list);
    }

    public function testCreateAliases()
    {
        $params = [CreateAliasOperation::fromArray([
            'create_alias' => [
                'collection_name' => $this->collectionName,
                'alias_name' => 'testAlias',
            ],
        ])];
        $result = $this->aliases->updateAliases($params);
        $this->assertTrue($result);
    }

    public function testRenameAliases()
    {
        $params = [
            CreateAliasOperation::fromArray([
                'create_alias' => [
                    'collection_name' => $this->collectionName,
                    'alias_name' => 'testAlias',
                ],
            ]),
            RenameAliasOperation::fromArray([
                'rename_alias' => [
                    'old_alias_name' => 'testAlias',
                    'new_alias_name' => 'newTestAlias',
                ],
            ]),
        ];
        $result = $this->aliases->updateAliases($params);
        $this->assertTrue($result);
    }

    public function testDeleteAliases()
    {
        $params = [
            CreateAliasOperation::fromArray([
                'create_alias' => [
                    'collection_name' => $this->collectionName,
                    'alias_name' => 'testAlias',
                ],
            ]),
            DeleteAliasOperation::fromArray([
                'delete_alias' => [
                    'alias_name' => 'testAlias',
                ],
            ]),
        ];
        $result = $this->aliases->updateAliases($params);
        $this->assertTrue($result);
    }
}
