<?php

declare(strict_types=1);

namespace App\Domain\Shared\Utils;

use ReflectionClass;
use RuntimeException;
use DateTimeImmutable;
use DateTimeInterface;
use function Lambdish\Phunctional\filter;
use function Lambdish\Phunctional\get_in;

final class Utils
{
    public static function endsWith(string $needle, string $haystack): bool
    {
        $length = \strlen($needle);
        if (0 === $length) {
            return true;
        }

        return \substr($haystack, -$length) === $needle;
    }

    public static function dateToString(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s.u');
    }

    public static function stringToDate(string $date): DateTimeImmutable
    {
        return new \DateTimeImmutable($date);
    }

    public static function jsonEncode(array $values): string
    {
        return \json_encode($values);
    }

    public static function jsonDecode(string $json): array
    {
        $data = \json_decode($json, true);

        if (\JSON_ERROR_NONE !== \json_last_error()) {
            throw new RuntimeException('Unable to parse response body into JSON: ' . \json_last_error());
        }

        return $data;
    }

    public static function toSnakeCase(string $text): string
    {
        return \ctype_lower($text) ? $text : \strtolower(\preg_replace('/([^A-Z\s])([A-Z])/', '$1_$2', $text));
    }

    public static function toCamelCase(string $text): string
    {
        return \lcfirst(\str_replace('_', '', \ucwords($text, '_')));
    }

    public static function dot($array, $prepend = ''): array
    {
        $results = [];
        foreach ($array as $key => $value) {
            if (\is_array($value) && !empty($value)) {
                $results = \array_merge($results, static::dot($value, $prepend . $key . '.'));
            } else {
                $results[$prepend . $key] = $value;
            }
        }

        return $results;
    }

    public static function extractValues(string $pathDotted, array $mapping)
    {
        try {
            $path = \explode('.', $pathDotted);
            $valueFound = get_in($path, $mapping);
            if (null === $valueFound) {
                $valueFound = '';
            }
        } catch (\Throwable $exception) {
            throw new \UnexpectedValueException(
                \sprintf(
                    'Field value error %s in current mapping: %s',
                    $exception->getMessage(),
                    self::jsonEncode($mapping)
                )
            );
        }

        return $valueFound;
    }

    public static function filesIn(string $path, $fileType): array
    {
        return filter(
            static fn (string $possibleModule) => \strstr($possibleModule, $fileType),
            \scandir($path)
        );
    }

    public static function extractClassName(object $object): string
    {
        $reflect = new ReflectionClass($object);

        return $reflect->getShortName();
    }
}
