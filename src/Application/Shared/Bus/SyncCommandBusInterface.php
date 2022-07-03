<?php

declare(strict_types=1);

namespace App\Application\Shared\Bus;

interface SyncCommandBusInterface
{
    /**
     * @return mixed
     */
    public function dispatch(object $command);
}
