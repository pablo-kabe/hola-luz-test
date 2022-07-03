<?php

namespace App\Domain\Readings\Converter;

interface ConverterFactory
{
    public function get(string $name): ?Converter;
}