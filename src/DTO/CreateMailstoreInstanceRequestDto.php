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
        return $this->with('alias', $value);
    }

    /**
     * Instance display name
     *
     * @return string
     */
    public function getDisplayName(): string
    {
        return (string) $this->required('displayName');
    }

    /**
     * Set the "displayName" field. Instance display name
     *
     * @return static
     */
    public function withDisplayName(?string $value): static
    {
        return $this->with('displayName', $value);
    }

    /**
     * Instance admin password
     *
     * @return string
     */
    public function getPassword(): string
    {
        return (string) $this->required('password');
    }

    /**
     * Set the "password" field. Instance admin password
     *
     * @return static
     */
    public function withPassword(?string $value): static
    {
        return $this->with('password', $value);
    }
}
