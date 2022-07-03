<?php

declare(strict_types=1);

namespace App\Domain\Shared\ValueObject;

use App\Domain\Shared\Utils\Utils;
use ReflectionClass;
use function Lambdish\Phunctional\reindex;

abstract class Enum
{
    protected static array $cache = [];
    protected $value;

    public function __construct($value)
    {
        $this->ensureIsBetweenAcceptedValues($value);

        $this->value = $value;
    }

    public static function __callStatic(string $name, $args)
    {
        return new static(self::values()[$name]);
    }

    public function __toString(): string
    {
        return (string) $this->value();
    }

    public static function fromString(string $value): self
    {
        return new static($value);
    }

    public static function values(): array
    {
        $class = static::class;

        if (!isset(self::$cache[$class])) {
            $reflected = new ReflectionClass($class);
            self::$cache[$class] = reindex(self::keysFormatter(), $reflected->getConstants());
        }

        return self::$cache[$class];
    }

    public static function randomValue()
    {
        return self::values()[\array_rand(self::values())];
    }

    public static function random(): self
    {
        return new static(self::randomValue());
    }

    public function value()
    {
        return $this->value;
    }

    public function equals(self $other): bool
    {
        return $other === $this;
    }

    abstract protected function throwExceptionForInvalidValue($value);

    private static function keysFormatter(): callable
    {
        return static fn ($unused, string $key): string => Utils::toCamelCase(\strtolower($key));
    }

    private function ensureIsBetweenAcceptedValues($value): void
    {
        if (!\in_array($value, static::values(), true)) {
            $this->throwExceptionForInvalidValue($value);
        }
    }
}
