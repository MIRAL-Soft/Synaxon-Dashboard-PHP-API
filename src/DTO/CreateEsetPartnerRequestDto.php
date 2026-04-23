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
     * Partner email
     *
     * @return string
     */
    public function getEmail(): string
    {
        return (string) $this->data['email'];
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
}
