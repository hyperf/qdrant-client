<?php

namespace Hyperf\Qdrant\Api;

use Hyperf\Qdrant\Connection\ClientInterface;

abstract class AbstractApi
{
    public function __construct(protected ClientInterface $client)
    {
    }
}