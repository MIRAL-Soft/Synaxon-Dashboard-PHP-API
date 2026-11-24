<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CreateCyanSecurityCustomerRequestDto extends AbstractDto
{
    /**
     * @return float|null
     */
    public function getCustomerId(): ?float
    {
        $v = $this->data['customerId'] ?? null;
        return $v === null ? null : (float) $v;
    }

    /**
     * Set the "customerId" field.
     *
     * @return static
     */
    public function withCustomerId(?float $value): static
    {
        return $this->with('customerId', $value);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->required('name');
    }

    /**
     * Set the "name" field.
     *
     * @return static
     */
    public function withName(?string $value): static
    {
        return $this->with('name', $value);
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return (string) $this->required('email');
    }

    /**
     * Set the "email" field.
     *
     * @return static
     */
    public function withEmail(?string $value): static
    {
        return $this->with('email', $value);
    }

    /**
     * @return string
     */
    public function getPackageType(): string
    {
        return (string) $this->required('packageType');
    }

    /**
     * Set the "packageType" field.
     *
     * @return static
     */
    public function withPackageType(?string $value): static
    {
        return $this->with('packageType', $value);
    }
}
