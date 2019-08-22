<?php

namespace App\Domain;

interface WriterInterface
{
    public function write(string $data): bool;
}
