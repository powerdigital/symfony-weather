<?php

namespace App\Infrastructure\Formatter;

use App\Domain\Entity\WeatherInfo;
use App\Domain\FormatterInterface;
use DateTime;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class JsonFormatter implements FormatterInterface
{
    public function format(WeatherInfo $info): string
    {
        $data = [
            'time' => $info->getTime()->format(DateTime::ATOM),
            'temperature' => $info->getTemperature(),
            'windDirection' => $info->getWindDir(),
            'windSpeed' => $info->getWindSpeed(),
            'feelsLike' => $info->getFeelsLike(),
            'pressure' => $info->getPressure(),
        ];

        $serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);

        return $serializer->serialize($data, 'json');
    }
}
