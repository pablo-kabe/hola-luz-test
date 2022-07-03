<?php

namespace App\Application\Readings\Converter\File;

use App\Domain\Shared\Bus\Command;

class ImporterReadingsFile implements Command
{
    private string $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    public function filePath(): string
    {
        return $this->filePath;
    }

    public function extension(): string
    {
        $explode = explode('.', $this->filePath);

        return $explode[count($explode) - 1];
    }
}