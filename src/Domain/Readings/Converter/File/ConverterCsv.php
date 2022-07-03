<?php

namespace App\Domain\Readings\Converter\File;

use App\Domain\Readings\Converter\Converter;
use App\Domain\Readings\Converter\ConverterSource;
use App\Domain\Readings\Reading;

class ConverterCsv implements Converter
{
    public function convert(ConverterSource $source): array
    {
        $filePath = $source->value();
        $result = [];

        $handle = fopen($filePath, 'r');
        $first = true;
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                if ($first) {
                    $first = false;
                    continue;
                }
                $data = explode(',', $line);
                $reading = Reading::create($data[0], \DateTime::createFromFormat('Y-m', $data[1]), $data[2]);
                $result[] = $reading;
            }
            fclose($handle);
        }

        return $result;
    }

    public function name(): string
    {
        return 'csv';
    }
}