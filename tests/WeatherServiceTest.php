<?php

namespace App\Tests;

use App\Domain\ClientInterface;
use App\Domain\Entity\WeatherInfo;
use App\Domain\Service\WeatherService;
use App\Infrastructure\Client\GuzzleClient;
use App\Infrastructure\Provider\YandexApi;
use App\Infrastructure\FormatterFactory;
use App\Infrastructure\ProviderFactory;
use PHPUnit\Framework\TestCase;

class WeatherServiceTest extends TestCase
{
    private const PROVIDER = 'yandex';

    private const FORMAT = 'json';

    /**
     * @var ClientInterface
     */
    private $client;

    protected function setUp()
    {
        parent::setUp();

        $rawData = file_get_contents(__DIR__ . '/Fixtures/weather_info.json');
        $this->assertIsString($rawData);
        $this->assertJson($rawData);

        $this->client = $this->createMock(GuzzleClient::class);
        $this->client->method('load')->willReturn($rawData);
    }

    public function testService()
    {
        $providerFactory = new ProviderFactory($this->client, self::PROVIDER);
        $provider = $providerFactory->make();
        $this->assertInstanceOf(YandexApi::class, $provider);

        $formatterFactory = new FormatterFactory(self::FORMAT);
        $formatter = $formatterFactory->make();

        $service = new WeatherService($provider, $formatter);
        $formattedData = $service->getFormattedInfo();
        $this->assertIsString($formattedData);
    }

    /**
     * @throws \Exception
     */
    public function testGetInfo()
    {
        $stub = $this->createMock(YandexApi::class);

        $weatherInfo = $stub->getInfo();
        $this->assertInstanceOf(WeatherInfo::class, $weatherInfo);
    }
}
