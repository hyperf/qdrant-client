<?php

namespace Hyperf\Qdrant\Api;

use Hyperf\Qdrant\Connection\ClientInterface;

abstract class AbstractApi
{
    public function __construct(protected ClientInterface $client)
    {
    }
    public function request(string $method, string $uri, array $body = null): mixed
    {
        if ($this->getQueryParams()) {
            $uri .= '?' . http_build_query($this->getQueryParams());
        }
        return $this->client->request($method, $uri, $body);
    }

    protected function getQueryParams(): array
    {
        return [];
    }
}