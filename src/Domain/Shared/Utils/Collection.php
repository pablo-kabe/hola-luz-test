<?php

declare(strict_types=1);

namespace App\Domain\Shared\Utils;

use Countable;
use ArrayIterator;
use IteratorAggregate;
use function Lambdish\Phunctional\each;

abstract class Collection implements Countable, IteratorAggregate
{
    private array $items;

    public function __construct(array $items)
    {
        Assert::arrayOf($this->type(), $items);

        $this->items = $items;
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->items());
    }

    public function count(): int
    {
        return \count($this->items());
    }

    abstract protected function type(): string;

    protected function each(callable $fn): void
    {
        each($fn, $this->items());
    }

    protected function items(): array
    {
        return $this->items;
    }
}
