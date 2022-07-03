<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared\Tactician\Bus;

use League\Tactician\CommandBus;
use App\Application\Shared\Bus\QueryBusInterface;

class QueryBus implements QueryBusInterface
{
    private CommandBus $queryBus;

    public function __construct(CommandBus $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    /**
     * @return mixed|void
     */
    public function dispatch(object $query)
    {
        return $this->queryBus->handle($query);
    }
}
