<?php

declare(strict_types=1);

namespace App\Domain\Shared\ValueObject;

use Ramsey\Uuid\Uuid as RamseyUuid;
use Ramsey\Uuid\UuidInterface as RamseyUuidInterface;

/**
 * @property string hex
 * @property string binary
 */
class Uuid implements UuidInterface
{
    private RamseyUuidInterface $ramseyUuid;

    /**
     * @param ?string $value
     *
     * @throws \Exception
     */
    private function __construct(
        string $value = null
    ) {
        if (null === $value) {
            $this->ramseyUuid = RamseyUuid::uuid1();

            return;
        }

        if (false === RamseyUuid::isValid($value)) {
            throw new \Exception('Invalid UUID value.');
        }

        $this->ramseyUuid = RamseyUuid::fromString(
            $value
        );
    }

    public function __toString(): string
    {
        return $this->ramseyUuid->toString();
    }

    public static function create(): self
    {
        return new self();
    }

    public function getBytes(): string
    {
        return $this->ramseyUuid->getBytes();
    }

    public function getHex(): string
    {
        return $this->ramseyUuid->getHex()->toString();
    }

    public function equals(UuidInterface $uuid): bool
    {
        return $this->ramseyUuid->equals(
            RamseyUuid::fromString(
                $uuid->__toString()
            )
        );
    }

    /**
     * @throws \Exception
     */
    public static function fromString(string $string): UuidInterface
    {
        return new self($string);
    }

    /**
     * @throws \Exception
     */
    public static function fromBytes(
        string $bytes
    ): UuidInterface {
        return new self(
            RamseyUuid::fromBytes($bytes)->toString()
        );
    }
}
