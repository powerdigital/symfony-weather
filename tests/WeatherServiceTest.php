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
use DateTime;
use PHPUnit\Framework\TestCase;
use SimpleXMLElement;

class WeatherServiceTest extends TestCase
{
    private const PROVIDER = 'yandex';

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
        $providerFactory = new ProviderFactory($this->client, self::PROVIDER);
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
        $jsonString = $service->getFormattedInfo();
        $this->assertIsString($jsonString);
        $this->assertJson($jsonString);

        $formatterFactory->setFormat(self::FORMAT_XML);

        $xmlFormatter = $formatterFactory->make();
        $this->assertInstanceOf(XmlFormatter::class, $xmlFormatter);
        $service->setFormatter($xmlFormatter);
        $xmlString = $service->getFormattedInfo();
        $this->assertIsString($xmlString);

        $xml = new SimpleXMLElement('<response/>');
        $xml->addChild('time', '2016-08-03T10:30:06+00:00');
        $xml->addChild('windSpeed', 2);
        $xml->addChild('temperature', 20);
        $xml->addChild('feelsLike', 21);
        $xml->addChild('windDirection', 'n');
        $xml->addChild('pressure', 745);

        $this->assertXmlStringEqualsXmlString($xmlString, $xml->asXML());
    }

    /**
     * @throws \Exception
     */
    public function testGetInfo()
    {
        $provider = new YandexApi($this->client);

        $weatherInfo = $provider->getInfo();
        $this->assertInstanceOf(WeatherInfo::class, $weatherInfo);

        $this->assertIsInt($weatherInfo->getTemperature());
        $this->assertEquals($weatherInfo->getTemperature(), 20);

        $this->assertIsInt($weatherInfo->getFeelsLike());
        $this->assertEquals($weatherInfo->getFeelsLike(), 21);

        $this->assertIsInt($weatherInfo->getPressure());
        $this->assertEquals($weatherInfo->getPressure(), 745);

        $this->assertInstanceOf(DateTime::class, $weatherInfo->getTime());
        $this->assertEquals($weatherInfo->getTime(), new DateTime('2016-08-03 10:30:06.238'));

        $this->assertIsString($weatherInfo->getWindDir());
        $this->assertEquals($weatherInfo->getWindDir(), 'n');

        $this->assertIsInt($weatherInfo->getWindSpeed());
        $this->assertEquals($weatherInfo->getWindSpeed(), 2);
    }
}
