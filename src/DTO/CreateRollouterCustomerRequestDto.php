<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CreateRollouterCustomerRequestDto extends AbstractDto
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
    public function getPlan(): string
    {
        return (string) $this->required('plan');
    }

    /**
     * Set the "plan" field.
     *
     * @return static
     */
    public function withPlan(?string $value): static
    {
        return $this->with('plan', $value);
    }

    /**
     * @return float
     */
    public function getClientLimit(): float
    {
        return (float) $this->required('clientLimit');
    }

    /**
     * Set the "clientLimit" field.
     *
     * @return static
     */
    public function withClientLimit(?float $value): static
    {
        return $this->with('clientLimit', $value);
    }
}
