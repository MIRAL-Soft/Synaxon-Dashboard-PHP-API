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
        return $this->with('customerId', $value);
    }

    /**
     * The name of the customer
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->required('name');
    }

    /**
     * Set the "name" field. The name of the customer
     *
     * @return static
     */
    public function withName(?string $value): static
    {
        return $this->with('name', $value);
    }

    /**
     * This value is ignored
     *
     * @return float|null
     */
    public function getEmployees(): ?float
    {
        $v = $this->data['employees'] ?? null;
        return $v === null ? null : (float) $v;
    }

    /**
     * Set the "employees" field. This value is ignored
     *
     * @return static
     */
    public function withEmployees(?float $value): static
    {
        return $this->with('employees', $value);
    }

    /**
     * Billing cycle of customer
     *
     * @return string
     */
    public function getBillingCycle(): string
    {
        return (string) $this->required('billingCycle');
    }

    /**
     * Set the "billingCycle" field. Billing cycle of customer
     *
     * @return static
     */
    public function withBillingCycle(?string $value): static
    {
        return $this->with('billingCycle', $value);
    }

    /**
     * Operating mode of the customer in Sec Auditor
     *
     * @return string
     */
    public function getMode(): string
    {
        return (string) $this->required('mode');
    }

    /**
     * Set the "mode" field. Operating mode of the customer in Sec Auditor
     *
     * @return static
     */
    public function withMode(?string $value): static
    {
        return $this->with('mode', $value);
    }
}
