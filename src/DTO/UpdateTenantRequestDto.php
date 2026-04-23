<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class UpdateTenantRequestDto extends AbstractDto
{
    /**
     * Tenant name
     *
     * @return string|null
     */
    public function getDisplayName(): ?string
    {
        $v = $this->data['displayName'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * E-Mail address for alerting
     *
     * @return string|null
     */
    public function getAlertEmail(): ?string
    {
        $v = $this->data['alertEmail'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Support E-Mail Address for customers
     *
     * @return string|null
     */
    public function getSupportEmail(): ?string
    {
        $v = $this->data['supportEmail'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Support phone number for customers
     *
     * @return string|null
     */
    public function getSupportPhone(): ?string
    {
        $v = $this->data['supportPhone'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Support URL for customers
     *
     * @return string|null
     */
    public function getSupportUrl(): ?string
    {
        $v = $this->data['supportUrl'] ?? null;
        return $v === null ? null : (string) $v;
    }
}
