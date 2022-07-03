<?php

declare(strict_types=1);

namespace App\Domain\Shared\Logger;

interface LoggerInterface
{
    public function error(string $message): void;

    public function info(string $message): void;
}
