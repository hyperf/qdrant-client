# Hyperf Qdrant Client

## Install
```bash
composer require hyperf/qdrant-client
```

## Usage

An example to create a collection:
```php
use App\VectorStore\Qdrant\Config;
use Hyperf\Qdrant\Api\Collections;
use Hyperf\Qdrant\Api\Points;
use Hyperf\Qdrant\Connection\HttpClient;
use Hyperf\Qdrant\Struct\Collections\Enums\Distance;
use Hyperf\Qdrant\Struct\Collections\VectorParams;
use Hyperf\Qdrant\Struct\Points\ExtendedPointId;
use Hyperf\Qdrant\Struct\Points\Point\PointStruct;
use Hyperf\Qdrant\Struct\Points\SearchCondition\FieldCondition;
use Hyperf\Qdrant\Struct\Points\SearchCondition\Filter;
use Hyperf\Qdrant\Struct\Points\SearchCondition\Match\MatchValue;
use Hyperf\Qdrant\Struct\Points\VectorStruct;

$client = new HttpClient(new Config(...));

$collections = new Collections($client);
$collections->createCollection('test_collection', new VectorParams(1536, Distance::COSINE));

# insert vector data
$points = new Points($client);
$points->setWait(true);
$points->upsertPoints('test_collection', [
    new PointStruct(
        new ExtendedPointId($key + 10000),
        new VectorStruct($data['embeddings'][0]),
        [
            # payload
            'name' => $data['name'],
            'description' => $data['description'],
            'image' => $data['image'],
        ],
    ),
]);

# similarity search
$result = $points->searchPoints(
    'test_collection',
    new VectorStruct($data['embeddings'][0]),
    3,
    withPayload: new WithPayload(true),
);
print_r($result);

# payload filter
$result = $points->searchPoints(
    'test_collection',
    new VectorStruct($data['embeddings'][0]),
    3,
    new Filter(
        must: [
            new FieldCondition('name', new MatchValue('qdrant')),
        ]
    ),
    withPayload: new WithPayload(true),
);
print_r($result);
```