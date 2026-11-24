<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CreateApiTokenRequestDto extends AbstractDto
{
    /**
     * Name of the API token
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->required('name');
    }

    /**
     * Set the "name" field. Name of the API token
     *
     * @return static
     */
    public function withName(?string $value): static
    {
        return $this->with('name', $value);
    }

    /**
     * Expiration date of the API token
     *
     * @return string
     */
    public function getExpiresAt(): string
    {
        return (string) $this->required('expiresAt');
    }

    /**
     * Set the "expiresAt" field. Expiration date of the API token
     *
     * @return static
     */
    public function withExpiresAt(?string $value): static
    {
        return $this->with('expiresAt', $value);
    }
}
