<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CreateCustomerReferenceRequestDto extends AbstractDto
{
    /**
     * The reference ID
     *
     * @return string
     */
    public function getReferenceId(): string
    {
        return (string) $this->data['referenceId'];
    }

    /**
     * Set the "referenceId" field. The reference ID
     *
     * @return static
     */
    public function withReferenceId(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('referenceId', $value);
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

    /**
     * Set the "system" field. The system of the reference
     *
     * @return static
     */
    public function withSystem(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('system', $value);
    }
}
