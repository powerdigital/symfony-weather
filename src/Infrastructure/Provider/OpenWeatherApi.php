<?php

namespace App\Infrastructure\Provider;

use App\Domain\Entity\WeatherInfo;
use App\Domain\ProviderInterface;

class OpenWeatherApi implements ProviderInterface
{
    public function load(): WeatherInfo
    {
        // TODO: Implement load() method.
    }
}