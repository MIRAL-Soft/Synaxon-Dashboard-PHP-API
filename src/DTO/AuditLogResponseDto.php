<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class AuditLogResponseDto extends AbstractDto
{
    /**
     * Entity unique identifier
     *
     * @return string
     */
    public function getId(): string
    {
        return (string) $this->data['id'];
    }

    /**
     * Entity creation date and time
     *
     * @return string
     */
    public function getCreatedAt(): string
    {
        return (string) $this->data['createdAt'];
    }

    /**
     * Date and time of last update
     *
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return (string) $this->data['updatedAt'];
    }

    /**
     * The entity type
     *
     * @return string
     */
    public function getEntityType(): string
    {
        return (string) $this->data['entityType'];
    }

    /**
     * The entity id
     *
     * @return string
     */
    public function getEntityId(): string
    {
        return (string) $this->data['entityId'];
    }

    /**
     * The action
     *
     * @return string
     */
    public function getAction(): string
    {
        return (string) $this->data['action'];
    }

    /**
     * The sub action
     *
     * @return string|null
     */
    public function getSubAction(): ?string
    {
        $v = $this->data['subAction'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * The entity raw
     *
     * @return array<string, mixed>
     */
    public function getEntityRaw(): array
    {
        return (array) ($this->data['entityRaw'] ?? []);
    }

    /**
     * The tenant id
     *
     * @return string
     */
    public function getTenantId(): string
    {
        return (string) $this->data['tenantId'];
    }

    /**
     * The user id
     *
     * @return string
     */
    public function getUserId(): string
    {
        return (string) $this->data['userId'];
    }

    /**
     * The tenant name
     *
     * @return string
     */
    public function getTenantName(): string
    {
        return (string) $this->data['tenantName'];
    }

    /**
     * The user name
     *
     * @return string
     */
    public function getUserName(): string
    {
        return (string) $this->data['userName'];
    }
}
