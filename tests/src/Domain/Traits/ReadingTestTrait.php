<?php

namespace App\Tests\Domain\Traits;

use App\Domain\Readings\ReadingRepository;

trait ReadingTestTrait
{
    /**
     * @var ReadingRepository|MockInterface
     */
    private $readingRepository;

    private function readingRepository(): ReadingRepository
    {
        if (null === $this->readingRepository) {
            $this->readingRepository = \Mockery::mock(ReadingRepository::class);
        }

        return $this->readingRepository;
    }
}