<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CreateMailstoreInstanceRequestDto extends AbstractDto
{
    /**
     * Customer ID
     *
     * @return float|null
     */
    public function getCustomerId(): ?float
    {
        $v = $this->data['customerId'] ?? null;
        return $v === null ? null : (float) $v;
    }

    /**
     * Set the "customerId" field. Customer ID
     *
     * @return static
     */
    public function withCustomerId(?float $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('customerId', $value);
    }

    /**
     * Instance alias
     *
     * @return string|null
     */
    public function getAlias(): ?string
    {
        $v = $this->data['alias'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Set the "alias" field. Instance alias
     *
     * @return static
     */
    public function withAlias(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('alias', $value);
    }

    /**
     * Instance display name
     *
     * @return string
     */
    public function getDisplayName(): string
    {
        return (string) $this->data['displayName'];
    }

    /**
     * Set the "displayName" field. Instance display name
     *
     * @return static
     */
    public function withDisplayName(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('displayName', $value);
    }

    /**
     * Instance admin password
     *
     * @return string
     */
    public function getPassword(): string
    {
        return (string) $this->data['password'];
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
