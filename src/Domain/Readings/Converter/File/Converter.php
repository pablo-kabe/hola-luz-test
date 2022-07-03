<?php

namespace App\Domain\Readings\Converter\File;

use App\Domain\Readings\Converter\ConverterFactory;
use App\Domain\Readings\Converter\ConverterSource;

class Converter
{
    private ConverterFactory $factory;

    public function __construct(ConverterFactory $factory)
    {
        $this->factory = $factory;
    }

    public function __invoke(string $extension, string $path): array
    {
        $service = $this->factory->get($extension);
        $readings = $service->convert(new ConverterSource($path));

        return $readings;
    }
}