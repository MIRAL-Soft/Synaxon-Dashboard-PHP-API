<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class UpdateMailstoreInstanceRequestDto extends AbstractDto
{
    /**
     * Customer ID of customer file
     *
     * @return float|null
     */
    public function getCustomerId(): ?float
    {
        $v = $this->data['customerId'] ?? null;
        return $v === null ? null : (float) $v;
    }

    /**
     * Set the "customerId" field. Customer ID of customer file
     *
     * @return static
     */
    public function withCustomerId(?float $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('customerId', $value);
    }

    /**
     * Customer name
     *
     * @return string|null
     */
    public function getDisplayName(): ?string
    {
        $v = $this->data['displayName'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Set the "displayName" field. Customer name
     *
     * @return static
     */
    public function withDisplayName(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('displayName', $value);
    }

    /**
     * Alias of mailstore instance
     *
     * @return string|null
     */
    public function getAlias(): ?string
    {
        $v = $this->data['alias'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Set the "alias" field. Alias of mailstore instance
     *
     * @return static
     */
    public function withAlias(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('alias', $value);
    }

    /**
     * Instance admin password
     *
     * @return string|null
     */
    public function getPassword(): ?string
    {
        $v = $this->data['password'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Set the "password" field. Instance admin password
     *
     * @return static
     */
    public function withPassword(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('password', $value);
    }
}
