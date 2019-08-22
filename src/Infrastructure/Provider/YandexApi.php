<?php

namespace App\Infrastructure\Provider;

use App\Domain\AbstractProvider;
use App\Domain\Entity\WeatherInfo;
use DateTime;

class YandexApi extends AbstractProvider
{
    /**
     * @return void
     *
     * @throws \Exception
     */
    public function convertResponse()
    {
        $data = json_decode(
            $this->response,
            JSON_UNESCAPED_UNICODE | JSON_PARTIAL_OUTPUT_ON_ERROR
        );

        $info = new WeatherInfo();

        $info->setTime(new DateTime($data['now_dt']));
        $info->setTemperature($data['fact']['temp']);
        $info->setFeelsLike($data['fact']['feels_like']);
        $info->setPressure($data['fact']['pressure_mm']);
        $info->setWindDir($data['fact']['wind_dir']);
        $info->setWindSpeed($data['fact']['wind_speed']);

        $this->weatherInfo = $info;
    }
}
