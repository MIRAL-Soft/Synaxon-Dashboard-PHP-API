<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CreateEsetPartnerRequestDto extends AbstractDto
{
    /**
     * Tenant ID
     *
     * @return string
     */
    public function getTenantId(): string
    {
        return (string) $this->data['tenantId'];
    }

    /**
     * Set the "tenantId" field. Tenant ID
     *
     * @return static
     */
    public function withTenantId(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('tenantId', $value);
    }

    /**
     * Partner email
     *
     * @return string
     */
    public function getEmail(): string
    {
        return (string) $this->data['email'];
    }

    /**
     * Set the "email" field. Partner email
     *
     * @return static
     */
    public function withEmail(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('email', $value);
    }

    /**
     * Management type (defaults to fullManaged)
     *
     * @return string|null
     */
    public function getManagementType(): ?string
    {
        $v = $this->data['managementType'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Set the "managementType" field. Management type (defaults to fullManaged)
     *
     * @return static
     */
    public function withManagementType(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('managementType', $value);
    }
}
