<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared\Tactician\Bus\Message;

class AsyncDelayedMessage
{
    private object $command;

    private int $delayInMilliseconds;

    public function __construct(
        object $command,
        int $delayInMilliseconds
    ) {
        $this->command = $command;
        $this->delayInMilliseconds = $delayInMilliseconds;
    }

    public function getCommand(): object
    {
        return $this->command;
    }

    public function getDelayInMilliseconds(): int
    {
        return $this->delayInMilliseconds;
    }
}
