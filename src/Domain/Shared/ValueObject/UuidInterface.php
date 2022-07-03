<?php

declare(strict_types=1);

namespace App\Domain\Shared\ValueObject;

interface UuidInterface
{
    public function __toString(): string;

    public static function create(): self;

    public function getBytes(): string;

    public function getHex(): string;

    public function equals(self $uuid): bool;

    public static function fromString(string $string): self;

    public static function fromBytes(string $bytes): self;
}
