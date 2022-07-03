<?php

namespace App\Domain\Readings\Services\Finder;

use App\Domain\Readings\ReadingRepository;

class ReadingsMedianByClientFinder
{
    private ReadingRepository $readingRepository;

    public function __construct(ReadingRepository $readingRepository)
    {
        $this->readingRepository = $readingRepository;
    }

    public function __invoke()
    {
        return $this->readingRepository->findGroupByClientAndSumValue();
    }
}