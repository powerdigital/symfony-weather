<?php

namespace App\Tests;

use App\Domain\AbstractProvider;
use App\Domain\ClientInterface;
use App\Domain\Entity\WeatherInfo;
use App\Domain\Service\WeatherService;
use App\Infrastructure\Client\GuzzleClient;
use App\Infrastructure\Formatter\JsonFormatter;
use App\Infrastructure\Formatter\XmlFormatter;
use App\Infrastructure\Provider\YandexApi;
use App\Infrastructure\FormatterFactory;
use App\Infrastructure\ProviderFactory;
use PHPUnit\Framework\TestCase;

class WeatherServiceTest extends TestCase
{
    private const PROVIDER_YANDEX = 'yandex';

    private const FORMAT_JSON = 'json';

    private const FORMAT_XML = 'xml';

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var AbstractProvider
     */
    private $provider;

    protected function setUp()
    {
        parent::setUp();

        $this->mockClient();
        $this->initProvider();
    }

    private function mockClient()
    {
        $rawData = file_get_contents(__DIR__ . '/Fixtures/weather_info.json');
        $this->assertIsString($rawData);
        $this->assertJson($rawData);

        $this->client = $this->createMock(GuzzleClient::class);
        $this->client->method('load')->willReturn($rawData);
    }

    private function initProvider()
    {
        $providerFactory = new ProviderFactory($this->client, self::PROVIDER_YANDEX);
        $provider = $providerFactory->make();
        $this->assertInstanceOf(YandexApi::class, $provider);

        $this->provider = $provider;
    }

    public function testService()
    {
        $formatterFactory = new FormatterFactory(self::FORMAT_JSON);

        $jsonFormatter = $formatterFactory->make();
        $this->assertInstanceOf(JsonFormatter::class, $jsonFormatter);
        $service = new WeatherService($this->provider, $jsonFormatter);
        $jsonData = $service->getFormattedInfo();
        $this->assertIsString($jsonData);

        $formatterFactory->setFormat(self::FORMAT_XML);

        $xmlFormatter = $formatterFactory->make();
        $this->assertInstanceOf(XmlFormatter::class, $xmlFormatter);
        $service->setFormatter($xmlFormatter);
        $xmlData = $service->getFormattedInfo();
        $this->assertIsString($xmlData);
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
