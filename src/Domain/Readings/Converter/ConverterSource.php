<?php

namespace App\Domain\Readings\Converter;

class ConverterSource
{
    private string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function value()
    {
        return $this->value;
    }
}