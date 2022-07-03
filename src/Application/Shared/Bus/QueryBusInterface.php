<?php

declare(strict_types=1);

namespace App\Application\Shared\Bus;

interface QueryBusInterface
{
    /**
     * @return mixed
     */
    public function dispatch(object $query);
}
