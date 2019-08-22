<?php

namespace App\Domain\Service;

use App\Domain\FormatterInterface;
use App\Domain\AbstractProvider;

class WeatherService
{
    /**
     * Provider object
     *
     * @var AbstractProvider
     */
    private $provider;

    /**
     * Formatter object
     *
     * @var FormatterInterface
     */
    private $formatter;

    public function __construct(
        AbstractProvider $provider,
        FormatterInterface $formatter
    ) {
        $this->provider = $provider;
        $this->formatter = $formatter;
    }

    public function getFormattedInfo(): string
    {
        $data = $this->provider->getInfo();

        return $this->formatter->format($data);
    }
}
