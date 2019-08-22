<?php

namespace App\Infrastructure\Formatter;

use App\Domain\Entity\WeatherInfo;
use App\Domain\FormatterInterface;

class JsonFormatter implements FormatterInterface
{
    public function format(WeatherInfo $data): string
    {
        // TODO: Implement write() method.
    }
}
