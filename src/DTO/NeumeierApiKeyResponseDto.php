<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class NeumeierApiKeyResponseDto extends AbstractDto
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
     * Whether the API key has been revoked
     *
     * @return bool
     */
    public function getRevoked(): bool
    {
        return (bool) $this->required('revoked');
    }

    /**
     * Expiration date
     *
     * @return string
     */
    public function getExpiresAt(): string
    {
        return (string) $this->required('expiresAt');
    }

    /**
     * user-defined title for this API key
     *
     * @return string
     */
    public function getTitle(): string
    {
        return (string) $this->required('title');
    }
}
