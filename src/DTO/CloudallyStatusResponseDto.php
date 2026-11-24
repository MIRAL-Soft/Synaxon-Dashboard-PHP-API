<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CloudallyStatusResponseDto extends AbstractDto
{
    /**
     * Entity unique identifier
     *
     * @return string
     */
    public function getId(): string
    {
        return (string) $this->required('id');
    }

    /**
     * Entity creation date and time
     *
     * @return string
     */
    public function getCreatedAt(): string
    {
        return (string) $this->required('createdAt');
    }

    /**
     * Date and time of last update
     *
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return (string) $this->required('updatedAt');
    }

    /**
     * The tenant ID
     *
     * @return string
     */
    public function getTenantId(): string
    {
        return (string) $this->required('tenantId');
    }

    /**
     * The ID of the corresponding Cloudally customer
     *
     * @return string
     */
    public function getParentId(): string
    {
        return (string) $this->required('parentId');
    }

    /**
     * The ID of the corresponding Cloudally task
     *
     * @return string
     */
    public function getTaskId(): string
    {
        return (string) $this->required('taskId');
    }

    /**
     * The entity name of the status entry
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->required('name');
    }

    /**
     * The backup size in bytes
     *
     * @return float
     */
    public function getSize(): float
    {
        return (float) $this->required('size');
    }

    /**
     * The source service of the backup
     *
     * @return string
     */
    public function getSource(): string
    {
        return (string) $this->required('source');
    }

    /**
     * The status of the backup
     *
     * @return string
     */
    public function getStatus(): string
    {
        return (string) $this->required('status');
    }

    /**
     * The date of the last backup attempt
     *
     * @return string|null
     */
    public function getLastBackup(): ?string
    {
        $v = $this->data['lastBackup'] ?? null;
        return $v === null ? null : (string) $v;
    }
}
