<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class SystemTaskResponseDto extends AbstractDto
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
     * The label/description of the system task
     *
     * @return string
     */
    public function getLabel(): string
    {
        return (string) $this->data['label'];
    }

    /**
     * The current status of the system task
     *
     * @return string
     */
    public function getStatus(): string
    {
        return (string) $this->data['status'];
    }

    /**
     * The result of the system task
     *
     * @return array<string, mixed>
     */
    public function getResult(): array
    {
        return (array) ($this->data['result'] ?? []);
    }
}
