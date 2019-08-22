<?php

namespace App\Infrastructure\Provider;

use App\Domain\AbstractProvider;
use App\Domain\Entity\WeatherInfo;

class GismeteoApi extends AbstractProvider
{
    function convertResponse(): WeatherInfo
    {
        // TODO: Implement convert() method.
    }
}
