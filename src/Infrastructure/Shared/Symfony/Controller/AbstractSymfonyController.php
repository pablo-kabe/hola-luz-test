<?php

namespace App\Infrastructure\Shared\Symfony\Controller;

use App\Application\Shared\Bus\QueryBusInterface;
use App\Application\Shared\Bus\SyncCommandBusInterface;
use App\Domain\Shared\Bus\Command;
use App\Domain\Shared\Bus\Query;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class AbstractSymfonyController extends AbstractController
{
    private SyncCommandBusInterface $commandBus;
    private QueryBusInterface $queryBus;

    public function __construct(
        SyncCommandBusInterface $commandBus,
        QueryBusInterface $queryBus
    ) {
        $this->commandBus = $commandBus;
        $this->queryBus = $queryBus;
    }

    protected function query(Query $query): Response
    {
        return $this->queryBus->dispatch($query);
    }

    protected function dispatch(Command $command): void
    {
        $this->commandBus->dispatch($command);
    }
}