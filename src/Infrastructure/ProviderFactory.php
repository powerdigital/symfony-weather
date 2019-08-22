<?php

namespace App\Infrastructure;

use App\Domain\AbstractProvider;
use App\Domain\ClientInterface;

class ProviderFactory
{
    private const PROVIDER_PATH = 'App\\Infrastructure\\Provider\\';

    private $client;
    private $provider;

    public function __construct(ClientInterface $client, string $provider)
    {
        $this->client = $client;
        $this->provider = $provider;
    }

    public function make(): AbstractProvider
    {
        $provider = ucfirst($this->provider);
        $className = self::PROVIDER_PATH . $provider . 'Api';

        return new $className($this->client);
    }
}
