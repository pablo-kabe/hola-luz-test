<?php

namespace App\Domain\Readings\Converter;

interface Converter
{
    public function convert(ConverterSource $source);

    public function name(): string;
}