<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Compat;

/**
 * Result of comparing an OpenAPI document with the surface this library
 * version implements. Immutable; every list is sorted.
 *
 * - missing*: in the API, not in this library (the API grew).
 * - removed*: in this library, no longer in the API (calls will fail).
 */
final class CompatibilityReport
{
    /**
     * @param list<string> $missingOperations "METHOD /path" the API offers and the library lacks
     * @param list<string> $removedOperations "METHOD /path" the library offers and the API dropped
     * @param list<string> $missingSchemas schema names without a DTO in this library
     * @param list<string> $removedSchemas DTO schema names the API no longer declares
     */
    public function __construct(
        public readonly int $specOperationCount,
        public readonly int $implementedOperationCount,
        public readonly int $specSchemaCount,
        public readonly int $implementedSchemaCount,
        public readonly array $missingOperations,
        public readonly array $removedOperations,
        public readonly array $missingSchemas,
        public readonly array $removedSchemas,
        public readonly ?string $specVersion = null,
    ) {
    }

    /**
     * True when the API and the library cover exactly the same operations
     * and schemas.
     */
    public function isCompatible(): bool
    {
        return $this->missingOperations === []
            && $this->removedOperations === []
            && $this->missingSchemas === []
            && $this->removedSchemas === [];
    }

    /**
     * True when calls this library makes may fail: an operation or schema it
     * relies on is gone. New, not yet supported API features alone do not
     * break anything.
     */
    public function hasBreakingDrift(): bool
    {
        return $this->removedOperations !== [] || $this->removedSchemas !== [];
    }

    /**
     * @return array{
     *     compatible: bool,
     *     breaking: bool,
     *     specVersion: string|null,
     *     operations: array{spec: int, implemented: int, missing: list<string>, removed: list<string>},
     *     schemas: array{spec: int, implemented: int, missing: list<string>, removed: list<string>}
     * }
     */
    public function toArray(): array
    {
        return [
            'compatible' => $this->isCompatible(),
            'breaking' => $this->hasBreakingDrift(),
            'specVersion' => $this->specVersion,
            'operations' => [
                'spec' => $this->specOperationCount,
                'implemented' => $this->implementedOperationCount,
                'missing' => $this->missingOperations,
                'removed' => $this->removedOperations,
            ],
            'schemas' => [
                'spec' => $this->specSchemaCount,
                'implemented' => $this->implementedSchemaCount,
                'missing' => $this->missingSchemas,
                'removed' => $this->removedSchemas,
            ],
        ];
    }
}
