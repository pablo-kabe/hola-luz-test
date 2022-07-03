<?php

namespace App\Domain\Readings\Converter\File;

use App\Domain\Readings\Converter\Converter;
use App\Domain\Readings\Converter\ConverterSource;

class ConverterXml implements Converter
{
    public function convert(ConverterSource $source)
    {
        $filePath = $source->value();

    }

    public function name(): string
    {
        return 'xml';
    }
}