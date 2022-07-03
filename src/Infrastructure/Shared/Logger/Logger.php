<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared\Logger;

use Psr\Log\LoggerInterface as PsrLoggerInterface;
use App\Domain\Shared\Logger\LoggerInterface;

class Logger implements LoggerInterface
{
    private PsrLoggerInterface $logger;

    public function __construct(
        PsrLoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    public function error(string $message): void
    {
        $this->logger->error($message);
    }

    public function info(string $message): void
    {
        $this->logger->info($message);
    }
}
