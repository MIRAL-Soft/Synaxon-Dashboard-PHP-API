<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CreateSecAuditorCustomerRequestDto extends AbstractDto
{
    /**
     * The customer file id of the customer
     *
     * @return float|null
     */
    public function getCustomerId(): ?float
    {
        $v = $this->data['customerId'] ?? null;
        return $v === null ? null : (float) $v;
    }

    /**
     * Set the "customerId" field. The customer file id of the customer
     *
     * @return static
     */
    public function withCustomerId(?float $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('customerId', $value);
    }

    /**
     * The name of the customer
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->data['name'];
    }

    /**
     * Set the "name" field. The name of the customer
     *
     * @return static
     */
    public function withName(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('name', $value);
    }

    /**
     * This value is ignored
     *
     * @return float
     */
    public function getEmployees(): float
    {
        return (float) $this->data['employees'];
    }

    /**
     * Set the "employees" field. This value is ignored
     *
     * @return static
     */
    public function withEmployees(?float $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('employees', $value);
    }

    /**
     * Billing cycle of customer
     *
     * @return string
     */
    public function getBillingCycle(): string
    {
        return (string) $this->data['billingCycle'];
    }

    /**
     * Set the "billingCycle" field. Billing cycle of customer
     *
     * @return static
     */
    public function withBillingCycle(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('billingCycle', $value);
    }

    /**
     * Operating mode of the customer in Sec Auditor
     *
     * @return string
     */
    public function getMode(): string
    {
        return (string) $this->data['mode'];
    }

    /**
     * Set the "mode" field. Operating mode of the customer in Sec Auditor
     *
     * @return static
     */
    public function withMode(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('mode', $value);
    }
}
