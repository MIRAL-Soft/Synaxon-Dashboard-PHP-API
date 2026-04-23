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
     * The id of the entity
     *
     * @return string
     */
    public function getEntityId(): string
    {
        return (string) $this->data['entityId'];
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
     * Raw properties of entity
     *
     * @return array<string, mixed>
     */
    public function getEntityRaw(): array
    {
        return (array) ($this->data['entityRaw'] ?? []);
    }
}
