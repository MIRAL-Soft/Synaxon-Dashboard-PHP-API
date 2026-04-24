<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CreateLywandPartnerRequestDto extends AbstractDto
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
     * Set the "tenantId" field. The tenantId of the partner
     *
     * @return static
     */
    public function withTenantId(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('tenantId', $value);
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
     * Set the "type" field. The type of the partner
     *
     * @return static
     */
    public function withType(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('type', $value);
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
     * Set the "email" field. The email address for first user
     *
     * @return static
     */
    public function withEmail(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('email', $value);
    }
}
