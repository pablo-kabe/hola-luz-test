<?php

declare(strict_types=1);

namespace App\Application\Shared\Bus;

interface AsyncCommandBusInterface
{
    public function dispatch(object $command, int $delayInMilliseconds = 0): void;
}
