<?php

namespace App\Domain\Readings\Services\Creator;

use App\Domain\Readings\Reading;
use App\Domain\Readings\ReadingRepository;

class ReadingCreator
{
    public ReadingRepository $readingRepository;

    public function __construct(ReadingRepository $readingRepository)
    {
        $this->readingRepository = $readingRepository;
    }

    public function __invoke(Reading $reading)
    {
        $this->readingRepository->store($reading);
    }
}