<?php

namespace App\Domain;

use App\Domain\Entity\WeatherInfo;

interface ProviderInterface
{
    public function load(): WeatherInfo;
}
