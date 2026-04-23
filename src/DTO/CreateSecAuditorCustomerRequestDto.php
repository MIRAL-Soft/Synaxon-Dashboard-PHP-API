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
     * The name of the customer
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->data['name'];
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
     * Billing cycle of customer
     *
     * @return string
     */
    public function getBillingCycle(): string
    {
        return (string) $this->data['billingCycle'];
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
}
