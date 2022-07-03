<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared\Symfony\Command;

use Symfony\Component\Console\Command\Command;
use App\Application\Shared\Bus\SyncCommandBusInterface;
use App\Application\Shared\Bus\AsyncCommandBusInterface;

abstract class AbstractSymfonyCommand extends Command
{
    private SyncCommandBusInterface $syncCommandBus;
    private AsyncCommandBusInterface $asyncCommandBus;

    public function __construct(
        SyncCommandBusInterface $syncCommandBus,
        AsyncCommandBusInterface $asyncCommandBus
    ) {
        parent::__construct();
        $this->syncCommandBus = $syncCommandBus;
        $this->asyncCommandBus = $asyncCommandBus;
    }

    public function getSyncCommandBus(): SyncCommandBusInterface
    {
        return $this->syncCommandBus;
    }

    public function getAsyncCommandBus(): AsyncCommandBusInterface
    {
        return $this->asyncCommandBus;
    }
}
