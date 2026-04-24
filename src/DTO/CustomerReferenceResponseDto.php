<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CustomerReferenceResponseDto extends AbstractDto
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
     * The ID of the customer
     *
     * @return float
     */
    public function getCustomerId(): float
    {
        return (float) $this->data['customerId'];
    }

    /**
     * The ID of the reference
     *
     * @return string
     */
    public function getReferenceId(): string
    {
        return (string) $this->data['referenceId'];
    }

    /**
     * The system of the reference
     *
     * @return string
     */
    public function getSystem(): string
    {
        return (string) $this->data['system'];
    }
}
