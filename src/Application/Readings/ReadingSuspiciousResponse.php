<?php


namespace App\Application\Readings;


class ReadingSuspiciousResponse
{
    private string $clientId;
    private string $month;
    private float $suspiciousValue;
    private float $median;

    public function __construct(string $clientId, string $month, float $suspiciousValue, float $median)
    {
        $this->clientId = $clientId;
        $this->month = $month;
        $this->suspiciousValue = $suspiciousValue;
        $this->median = $median;
    }

    /**
     * @return string
     */
    public function clientId(): string
    {
        return $this->clientId;
    }

    /**
     * @return string
     */
    public function month(): string
    {
        return $this->month;
    }

    /**
     * @return float
     */
    public function suspiciousValue(): float
    {
        return $this->suspiciousValue;
    }

    /**
     * @return float
     */
    public function median(): float
    {
        return $this->median;
    }

    public function __toString()
    {
        return sprintf(
            'ClientId: %s - Month: %s - SuspiciousValue: %s - Median: %s',
            $this->clientId,
            $this->month,
            $this->suspiciousValue,
            $this->median
        );
    }

}