<?php

namespace App\Domain\Entity;

use DateTime;

class WeatherInfo
{
    /**
     * @var DateTime
     */
    private $time;

    /**
     * @var int
     */
    private $temperature;

    /**
     * @var int
     */
    private $feelsLike;

    /**
     * @var int
     */
    private $pressure;

    /**
     * @var int
     */
    private $windSpeed;

    /**
     * @var string
     */
    private $windDir;

    public function __construct()
    {
    }

    /**
     * @return DateTime
     */
    public function getTime(): DateTime
    {
        return $this->time;
    }

    /**
     * @param DateTime $time
     */
    public function setTime(DateTime $time): void
    {
        $this->time = $time;
    }

    /**
     * @return int
     */
    public function getTemperature(): int
    {
        return $this->temperature;
    }

    /**
     * @param int $temperature
     */
    public function setTemperature(int $temperature): void
    {
        $this->temperature = $temperature;
    }

    /**
     * @return int
     */
    public function getFeelsLike(): int
    {
        return $this->feelsLike;
    }

    /**
     * @param int $feelsLike
     */
    public function setFeelsLike(int $feelsLike): void
    {
        $this->feelsLike = $feelsLike;
    }

    /**
     * @return int
     */
    public function getPressure(): int
    {
        return $this->pressure;
    }

    /**
     * @param int $pressure
     */
    public function setPressure(int $pressure): void
    {
        $this->pressure = $pressure;
    }

    /**
     * @return int
     */
    public function getWindSpeed(): int
    {
        return $this->windSpeed;
    }

    /**
     * @param int $windSpeed
     */
    public function setWindSpeed(int $windSpeed): void
    {
        $this->windSpeed = $windSpeed;
    }

    /**
     * @return string
     */
    public function getWindDir(): string
    {
        return $this->windDir;
    }

    /**
     * @param string $windDir
     */
    public function setWindDir(string $windDir): void
    {
        $this->windDir = $windDir;
    }
}
