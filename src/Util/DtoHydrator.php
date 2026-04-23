<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Util;

use miralsoft\synaxon\api\DTO\AbstractDto;

/**
 * Converts raw JSON payloads into typed DTO instances and collections.
 */
final class DtoHydrator
{
    /**
     * Hydrate a single DTO from an associative array.
     *
     * @template T of AbstractDto
     * @param  class-string<T>     $class
     * @param  array<string, mixed> $data
     * @return T
     */
    public static function hydrate(string $class, array $data): AbstractDto
    {
        /** @var T $instance */
        $instance = $class::fromArray($data);

        return $instance;
    }

    /**
     * Hydrate a list of DTOs.
     *
     * @template T of AbstractDto
     * @param  class-string<T>                   $class
     * @param  list<array<string, mixed>>        $items
     * @return list<T>
     */
    public static function hydrateMany(string $class, array $items): array
    {
        $out = [];
        foreach ($items as $item) {
            if (is_array($item)) {
                $out[] = self::hydrate($class, $item);
            }
        }

        return $out;
    }
}
