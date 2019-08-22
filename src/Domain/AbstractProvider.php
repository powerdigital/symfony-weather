<?php

namespace App\Domain;

use App\Domain\Entity\WeatherInfo;

abstract class AbstractProvider
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var string
     */
    protected $response;

    /**
     * @var WeatherInfo
     */
    protected $weatherInfo;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    abstract function convertResponse();

    public function getInfo(): WeatherInfo
    {
        $this->response = $this->client->load();

        $this->convertResponse();

        return $this->weatherInfo;
    }
}
