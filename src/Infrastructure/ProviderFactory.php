<?php

namespace App\Infrastructure;

use App\Domain\ProviderInterface;
use Throwable;

class ProviderFactory
{
    private $provider;

    public function __construct(string $provider)
    {
        $this->provider = $provider;
    }

    public function get(): ProviderInterface
    {
        try {
            $className = $this->provider . 'Api';
        } catch (Throwable $e) {

        }
    }
}
