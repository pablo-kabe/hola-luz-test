<?php

namespace App\Domain\Readings;

interface ReadingRepository
{
    public function store(Reading $reading);

    public function findGroupByClientAndSumValue();

    public function findByHigherOrLowerThanValue(string $clientId, float $max, float $min);
}