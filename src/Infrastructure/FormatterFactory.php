<?php

namespace App\Infrastructure;

use App\Domain\FormatterInterface;

class FormatterFactory
{
    private $format;

    public function __construct(string $format)
    {
        $this->format = $format;
    }

    public function get(): FormatterInterface {

    }
}
