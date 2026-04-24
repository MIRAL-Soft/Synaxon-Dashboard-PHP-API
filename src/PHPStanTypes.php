<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api;

/**
 * Central PHPStan type aliases for the recurring response shapes the
 * SYNAXON API uses. Importing them as `@phpstan-import-type` from a
 * resource method's PHPDoc gives consumers full IDE autocomplete on
 * the array offsets we hand back.
 *
 * This class is intentionally never instantiated — it exists solely to
 * carry the type definitions in one place.
 *
 * @phpstan-type PaginatedResponse array{
 *     data: list<array<string, mixed>>,
 *     totalItems: int,
 *     page: int,
 *     limit: int
 * }
 * @phpstan-type SingleObjectResponse array<string, mixed>
 * @phpstan-type RawBinaryResponse array{
 *     _raw: string,
 *     _contentType: string
 * }
 * @phpstan-type JsonScalarResponse array{
 *     value: bool|int|float|string
 * }
 * @phpstan-type ApiErrorBody array{
 *     statusCode?: int,
 *     message?: string,
 *     error?: string,
 *     correlationId?: string,
 *     subErrors?: list<string>
 * }
 *
 * @internal
 */
final class PHPStanTypes
{
    private function __construct()
    {
    }
}
