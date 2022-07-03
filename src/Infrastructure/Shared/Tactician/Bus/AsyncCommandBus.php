<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared\Tactician\Bus;

use League\Tactician\CommandBus;
use App\Application\Shared\Bus\AsyncCommandBusInterface;
use App\Infrastructure\Shared\Tactician\Bus\Message\AsyncDelayedMessage;

class AsyncCommandBus implements AsyncCommandBusInterface
{
    private CommandBus $asyncBus;

    public function __construct(CommandBus $asyncBus)
    {
        $this->asyncBus = $asyncBus;
    }

    public function dispatch(
        object $command,
        int $delayInMilliseconds = 0
    ): void {
        if ($delayInMilliseconds <= 0) {
            $this->asyncBus->handle($command);

            return;
        }

        $this->asyncBus->handle(
            new AsyncDelayedMessage(
                $command,
                $delayInMilliseconds
            )
        );
    }
}
