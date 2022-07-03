<?php

namespace App\Application\Readings\Converter\File;

use App\Domain\Readings\Converter\File\Converter;
use App\Domain\Readings\Services\Creator\ReadingCreator;
use App\Domain\Shared\Bus\Command;

class ImporterReadingsFileCommandHandler implements Command
{
    private Converter $converter;

    private ReadingCreator $readingCreator;

    public function __construct(Converter $converter, ReadingCreator $readingCreator)
    {
        $this->converter = $converter;
        $this->readingCreator = $readingCreator;
    }

    public function __invoke(ImporterReadingsFile $importerReadingsFile)
    {
        $readings = $this->converter->__invoke($importerReadingsFile->extension(), $importerReadingsFile->filePath());

        foreach ($readings as $reading) {
            $this->readingCreator->__invoke($reading);
        }
    }
}