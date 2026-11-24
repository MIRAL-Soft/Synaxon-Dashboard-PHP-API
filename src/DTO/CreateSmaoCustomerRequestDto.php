<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CreateSmaoCustomerRequestDto extends AbstractDto
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
     * The organization name
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->required('name');
    }

    /**
     * Set the "name" field. The organization name
     *
     * @return static
     */
    public function withName(?string $value): static
    {
        return $this->with('name', $value);
    }

    /**
     * The owner email address
     *
     * @return string
     */
    public function getOwnerEmail(): string
    {
        return (string) $this->required('ownerEmail');
    }

    /**
     * Set the "ownerEmail" field. The owner email address
     *
     * @return static
     */
    public function withOwnerEmail(?string $value): static
    {
        return $this->with('ownerEmail', $value);
    }

    /**
     * The owner first name
     *
     * @return string
     */
    public function getOwnerFirstName(): string
    {
        return (string) $this->required('ownerFirstName');
    }

    /**
     * Set the "ownerFirstName" field. The owner first name
     *
     * @return static
     */
    public function withOwnerFirstName(?string $value): static
    {
        return $this->with('ownerFirstName', $value);
    }

    /**
     * The owner last name
     *
     * @return string
     */
    public function getOwnerLastName(): string
    {
        return (string) $this->required('ownerLastName');
    }

    /**
     * Set the "ownerLastName" field. The owner last name
     *
     * @return static
     */
    public function withOwnerLastName(?string $value): static
    {
        return $this->with('ownerLastName', $value);
    }

    /**
     * The plan slug (payg, advanced, scale)
     *
     * @return string
     */
    public function getPlanSlug(): string
    {
        return (string) $this->required('planSlug');
    }

    /**
     * Set the "planSlug" field. The plan slug (payg, advanced, scale)
     *
     * @return static
     */
    public function withPlanSlug(?string $value): static
    {
        return $this->with('planSlug', $value);
    }

    /**
     * The plan commitment (monthly, yearly)
     *
     * @return string
     */
    public function getPlanCommitment(): string
    {
        return (string) $this->required('planCommitment');
    }

    /**
     * Set the "planCommitment" field. The plan commitment (monthly, yearly)
     *
     * @return static
     */
    public function withPlanCommitment(?string $value): static
    {
        return $this->with('planCommitment', $value);
    }
}
