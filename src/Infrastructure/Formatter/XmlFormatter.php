<?php

namespace App\Infrastructure\Formatter;

use App\Domain\Entity\WeatherInfo;
use App\Domain\FormatterInterface;
use DateTime;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class XmlFormatter implements FormatterInterface
{
    public function format(WeatherInfo $info): string
    {
        $data = [
            'time' => $info->getTime()->format(DateTime::ATOM),
            'windSpeed' => $info->getWindSpeed(),
            'temperature' => $info->getTemperature(),
            'feelsLike' => $info->getFeelsLike(),
            'windDirection' => $info->getWindDir(),
            'pressure' => $info->getPressure(),
        ];

        $serializer = new Serializer([new ObjectNormalizer()], [new XmlEncoder()]);

        return $serializer->serialize($data, 'xml');
    }
}
