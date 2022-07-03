<?php

namespace App\Infrastructure\Readings;

use App\Domain\Readings\Reading;
use App\Domain\Readings\ReadingRepository;

class InMemoryReadingRepository implements ReadingRepository
{
    private array $readings;

    public function store(Reading $reading)
    {
        $this->readings[] = $reading;
    }

    public function findGroupByClientAndSumValue()
    {
        $data = [];

        /** @var Reading $reading */
        foreach ($this->readings as $reading) {
            $data[$reading->clientId()][$reading->getYearCapturedAt()][] = $reading->value();
        }

        $result = [];

        foreach ($data as $clientId => $yearData) {
            foreach ($yearData as $year => $value) {
                $median = array_sum($value) / 12;
                $result[$clientId] = Reading::create($clientId, \DateTime::createFromFormat('Y', $year), $median);
            }
        }

        return $result;
    }

    public function findByHigherOrLowerThanValue(string $clientId, float $max, float $min): array
    {
        $result = [];

        /** @var Reading $reading */
        foreach($this->readings as $reading) {
            if ($reading->clientId() === $clientId
                && ($reading->value() > $max || $reading->value() < $min)
            ) {
                $result[] = $reading;
            }
        }

        return $result;
    }
}