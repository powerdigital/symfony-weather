<?php

namespace App\Infrastructure\Formatter;

use App\Domain\Entity\WeatherInfo;
use App\Domain\FormatterInterface;

class XmlFormatter implements FormatterInterface
{
    public function format(WeatherInfo $data): string
    {
        return '<xml>';
    }
}
