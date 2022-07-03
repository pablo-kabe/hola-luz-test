<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared\Tactician\Bus;

use League\Tactician\CommandBus;
use App\Application\Shared\Bus\SyncCommandBusInterface;

class SyncCommandBus implements SyncCommandBusInterface
{
    private CommandBus $syncBus;

    public function __construct(
        CommandBus $syncBus
    ) {
        $this->syncBus = $syncBus;
    }

    /**
     * @return mixed|void
     */
    public function dispatch(object $command)
    {
        return $this->syncBus->handle($command);
    }
}
