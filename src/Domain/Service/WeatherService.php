<?php

namespace App\Domain\Service;

class WeatherService
{
    private $provider;

    private $formatter;

    public function __construct(string $provider, string $format)
    {
        $this->initProvider($provider);
        $this->setFormatter($format);
    }

    private function initProvider(string $provider)
    {

    }

    private function setFormatter(string $format)
    {

    }
}
