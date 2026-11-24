<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class EsetProductResponseDto extends AbstractDto
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
     * @return string
     */
    public function getCode(): string
    {
        return (string) $this->required('code');
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->required('name');
    }

    /**
     * Whether the product can be activated
     *
     * @return bool
     */
    public function getActivatable(): bool
    {
        return (bool) $this->required('activatable');
    }

    /**
     * Whether the product can be booked
     *
     * @return bool
     */
    public function getBookable(): bool
    {
        return (bool) $this->required('bookable');
    }

    /**
     * Whether the product is offered as full service
     *
     * @return bool
     */
    public function getFullService(): bool
    {
        return (bool) $this->required('fullService');
    }

    /**
     * Default sorting priority; higher values appear first
     *
     * @return float
     */
    public function getSortPriority(): float
    {
        return (float) $this->required('sortPriority');
    }
}
