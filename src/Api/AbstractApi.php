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
