<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CreatePlainAuditLogRequestDto extends AbstractDto
{
    /**
     * The name of the entity
     *
     * @return string
     */
    public function getEntityType(): string
    {
        return (string) $this->data['entityType'];
    }

    /**
     * Set the "entityType" field. The name of the entity
     *
     * @return static
     */
    public function withEntityType(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('entityType', $value);
    }

    /**
     * The id of the entity
     *
     * @return string
     */
    public function getEntityId(): string
    {
        return (string) $this->data['entityId'];
    }

    /**
     * Set the "entityId" field. The id of the entity
     *
     * @return static
     */
    public function withEntityId(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('entityId', $value);
    }

    /**
     * Action to be logged
     *
     * @return string
     */
    public function getAction(): string
    {
        return (string) $this->data['action'];
    }

    /**
     * Set the "action" field. Action to be logged
     *
     * @return static
     */
    public function withAction(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('action', $value);
    }

    /**
     * Sub-Action to be logged
     *
     * @return string|null
     */
    public function getSubAction(): ?string
    {
        $v = $this->data['subAction'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Set the "subAction" field. Sub-Action to be logged
     *
     * @return static
     */
    public function withSubAction(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('subAction', $value);
    }

    /**
     * Raw properties of entity
     *
     * @return array<string, mixed>
     */
    public function getEntityRaw(): array
    {
        return (array) ($this->data['entityRaw'] ?? []);
    }

    /**
     * Set the "entityRaw" field. Raw properties of entity
     *
     * @return static
     */
    public function withEntityRaw(?array $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('entityRaw', $value);
    }
}
