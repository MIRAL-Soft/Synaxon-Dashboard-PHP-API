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
     * Set the "displayName" field. Tenant name
     *
     * @return static
     */
    public function withDisplayName(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('displayName', $value);
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
     * Set the "alertEmail" field. E-Mail address for alerting
     *
     * @return static
     */
    public function withAlertEmail(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('alertEmail', $value);
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
     * Set the "supportEmail" field. Support E-Mail Address for customers
     *
     * @return static
     */
    public function withSupportEmail(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('supportEmail', $value);
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
     * Set the "supportPhone" field. Support phone number for customers
     *
     * @return static
     */
    public function withSupportPhone(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('supportPhone', $value);
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

    /**
     * Set the "supportUrl" field. Support URL for customers
     *
     * @return static
     */
    public function withSupportUrl(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('supportUrl', $value);
    }
}
