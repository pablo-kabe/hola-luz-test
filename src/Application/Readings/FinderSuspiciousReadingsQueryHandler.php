<?php

namespace App\Application\Readings;

use App\Domain\Readings\Reading;
use App\Domain\Readings\Services\Finder\ReadingsHigherOrLowerValueFinder;
use App\Domain\Readings\Services\Finder\ReadingsMedianByClientFinder;
use App\Domain\Shared\Bus\QueryHandler;

class FinderSuspiciousReadingsQueryHandler implements QueryHandler
{
    private ReadingsMedianByClientFinder $readingsMedianByClienteFinder;
    private ReadingsHigherOrLowerValueFinder $readingsHigherOrLowerValueFinder;

    public function __construct(
        ReadingsMedianByClientFinder $readingsMedianByClienteFinder,
        ReadingsHigherOrLowerValueFinder $readingsHigherOrLowerValueFinder
    ) {
        $this->readingsMedianByClienteFinder = $readingsMedianByClienteFinder;
        $this->readingsHigherOrLowerValueFinder = $readingsHigherOrLowerValueFinder;
    }

    public function __invoke(FinderSuspiciousReadings $finderSuspiciousReadings)
    {
        $medianReadingsByClient = $this->readingsMedianByClienteFinder->__invoke();
        $result = [];

        /** @var Reading $readingByClient */
        foreach ($medianReadingsByClient as $readingByClient) {
            $maxValue = $readingByClient->value() + (($readingByClient->value() * 50) / 100);
            $minValue = $readingByClient->value() - (($readingByClient->value() * 50) / 100);
            $readingsHigherOrLower = $this->readingsHigherOrLowerValueFinder->__invoke($readingByClient->clientId(), $maxValue, $minValue);
            $result = array_merge($result, $readingsHigherOrLower);
        }

        $response = $this->toResponse($result, $medianReadingsByClient);

        return $response;
    }

    private function toResponse(array $result, array $medianReadingsByClient)
    {
        $responses = [];

        /** @var Reading $data */
        foreach ($result as $data) {
            $responses[] = new ReadingSuspiciousResponse(
                $data->clientId(),
                $data->getMonthCapturedAt(),
                $data->value(),
                $medianReadingsByClient[$data->clientId()]->value()
            );
        }

        return $responses;
    }
}