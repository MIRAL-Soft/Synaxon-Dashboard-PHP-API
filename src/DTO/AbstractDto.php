<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

use JsonException;
use JsonSerializable;

/**
 * Shared behaviour for all request/response DTOs.
 *
 * DTOs carry the raw associative payload in $data and expose typed accessors
 * in their subclasses. Passing unknown fields is allowed — they are preserved
 * in $data so callers can access future API fields via getRaw().
 */
abstract class AbstractDto implements JsonSerializable
{
    /**
     * @param array<string, mixed> $data Raw field values as received from (or to be sent to) the API.
     */
    public function __construct(protected array $data = [])
    {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        /** @phpstan-ignore-next-line new.static */
        return new static($data);
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return $this->data;
    }

    /**
     * @throws JsonException
     */
    public function toJson(): string
    {
        return json_encode($this->data, JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return $this->data;
    }

    public function getRaw(string $field): mixed
    {
        return $this->data[$field] ?? null;
    }

    /**
     * @return array<string, mixed>
     */
    public function getAllRaw(): array
    {
        return $this->data;
    }
}
