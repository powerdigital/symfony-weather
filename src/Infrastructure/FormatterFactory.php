<?php

namespace App\Infrastructure;

use App\Domain\FormatterInterface;

class FormatterFactory
{
    private const FORMATTER_PATH = 'App\\Infrastructure\\Formatter\\';

    private $format;

    public function __construct(string $format)
    {
        $this->format = $format;
    }

    public function make(): FormatterInterface
    {
        $format = ucfirst($this->format);
        $className = self::FORMATTER_PATH . $format . 'Formatter';

        return new $className;
    }
}
