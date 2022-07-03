<?php

namespace App\Infrastructure\Readings\Converter\Factory;

use App\Domain\Readings\Converter\Converter;
use App\Domain\Readings\Converter\ConverterFactory;
use function Lambdish\Phunctional\reduce;

class SymfonyConverterFactory implements ConverterFactory
{
    private array $mapping;

    public function __construct(iterable $converters)
    {
        $this->mapping = reduce($this->extract(), $converters, []);
    }

    public function get(string $name): ?Converter
    {
        if (!isset($this->mapping[$name])) {
            return null;
        }

        return $this->mapping[$name];
    }

    private function extract(): callable
    {
        return static function (array $extracted, Converter $converter) {
            $extracted[$converter->name()] = $converter;

            return $extracted;
        };
    }
}