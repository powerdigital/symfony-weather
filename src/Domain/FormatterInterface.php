<?php

namespace App\Domain;

use App\Domain\Entity\WeatherInfo;

interface FormatterInterface
{
    public function format(WeatherInfo $data): string;
}
