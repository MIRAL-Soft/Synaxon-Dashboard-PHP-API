<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class LifecycleInfoResponseDto extends AbstractDto
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
     * Name of the Information
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->data['name'];
    }

    /**
     * Type of the Information
     *
     * @return string
     */
    public function getType(): string
    {
        return (string) $this->data['type'];
    }

    /**
     * Release date of the Information
     *
     * @return string|null
     */
    public function getRelease(): ?string
    {
        $v = $this->data['release'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * End of life date of the Information
     *
     * @return string|null
     */
    public function getEol(): ?string
    {
        $v = $this->data['eol'] ?? null;
        return $v === null ? null : (string) $v;
    }
}
