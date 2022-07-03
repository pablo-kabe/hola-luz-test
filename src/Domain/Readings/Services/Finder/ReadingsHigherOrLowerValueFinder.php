<?php

namespace App\Domain\Readings\Services\Finder;

use App\Domain\Readings\ReadingRepository;

class ReadingsHigherOrLowerValueFinder
{
    private ReadingRepository $readingRepository;

    public function __construct(ReadingRepository $readingRepository)
    {
        $this->readingRepository = $readingRepository;
    }

    public function __invoke(string $clientId, float $max, float $min)
    {
        return $this->readingRepository->findByHigherOrLowerThanValue($clientId, $max, $min);
    }
}