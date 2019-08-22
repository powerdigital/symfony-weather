<?php

namespace App\Tests;

use App\Domain\Entity\WeatherInfo;
use App\Infrastructure\ProviderFactory;
use App\Infrastructure\FormatterFactory;
use PHPUnit\Framework\TestCase;

class WeatherServiceTest extends TestCase
{
    private const PROVIDER = 'yandex';

    private const WRITER = 'xml';

    public function testService()
    {
        $providerFactory = new ProviderFactory(self::PROVIDER);
        $provider = $providerFactory->get();

        $formatterFactory = new FormatterFactory(self::WRITER);
        $formatter = $formatterFactory->get();

        $data = $provider->load();
        $this->assertInstanceOf(WeatherInfo::class, $data);

        $result = $formatter->format($data);
        $this->assertIsString($result);
    }
}
