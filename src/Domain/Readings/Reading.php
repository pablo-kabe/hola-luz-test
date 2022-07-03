<?php

namespace App\Domain\Readings;

class Reading
{
    private string $clientId;

    private \DateTime $capturedAt;

    private float $value;

    private function __construct(string $clientId, \DateTime $capturedAt, float $value)
    {
        $this->clientId = $clientId;
        $this->capturedAt = $capturedAt;
        $this->value = $value;
    }

    public static function create(string $clientId, \DateTime $capturedAt, float $value): self
    {
        return new self($clientId, $capturedAt, $value);
    }

    public function value(): float
    {
        return $this->value;
    }

    public function clientId(): string
    {
        return $this->clientId;
    }

    public function getYearCapturedAt(): int
    {
        return (int)$this->capturedAt->format('Y');
    }

    public function getMonthCapturedAt(): int
    {
        return (int)$this->capturedAt->format('m');
    }
}