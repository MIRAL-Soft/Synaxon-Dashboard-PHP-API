<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CreateSecAuditorPartnerRequestDto extends AbstractDto
{
    /**
     * The tenantId of the partner
     *
     * @return string
     */
    public function getTenantId(): string
    {
        return (string) $this->data['tenantId'];
    }

    /**
     * The type of the partner
     *
     * @return string
     */
    public function getType(): string
    {
        return (string) $this->data['type'];
    }

    /**
     * The email address for first user
     *
     * @return string
     */
    public function getEmail(): string
    {
        return (string) $this->data['email'];
    }

    /**
     * The firstname of the first user
     *
     * @return string
     */
    public function getFirstname(): string
    {
        return (string) $this->data['firstname'];
    }

    /**
     * The lastname of the first user
     *
     * @return string
     */
    public function getLastname(): string
    {
        return (string) $this->data['lastname'];
    }
}
