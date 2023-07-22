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
namespace Hyperf\Qdrant\Connection;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\RequestOptions;
use Hyperf\Codec\Json;
use Hyperf\Qdrant\ConfigInterface;

class HttpClient implements ClientInterface
{
    protected Client $client;

    public function __construct(protected ConfigInterface $config)
    {
        $this->client = new Client([
            'base_uri' => new Uri($config->getScheme() . '://' . $config->getHost() . ':' . $config->getPort()),
            RequestOptions::HEADERS => [
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    public function request(string $method, $uri, array $body = null): mixed
    {
        $body = $body ? [RequestOptions::JSON => $body] : [];
        $result = $this->client->request($method, $uri, $body);

        $result = Json::decode($result->getBody()->getContents());
        if ($result['status'] !== 'ok') {
            throw new Exception($result['status']['error']);
        }
        return $result['result'];
    }
}
