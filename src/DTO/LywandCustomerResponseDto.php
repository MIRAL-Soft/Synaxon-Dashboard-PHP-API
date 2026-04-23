<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class LywandCustomerResponseDto extends AbstractDto
{
    /**
     * Entity unique identifier
     *
     * @return string
     */
    public function getId(): string
    {
        return (string) $this->data['id'];
    }

    /**
     * Entity creation date and time
     *
     * @return string
     */
    public function getCreatedAt(): string
    {
        return (string) $this->data['createdAt'];
    }

    /**
     * Date and time of last update
     *
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return (string) $this->data['updatedAt'];
    }

    /**
     * The customer id of customer file
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
     * The lywand tenantId of the customer
     *
     * @return string
     */
    public function getVendorId(): string
    {
        return (string) $this->data['vendorId'];
    }

    /**
     * The rating of the customer (A-F)
     *
     * @return string
     */
    public function getRating(): string
    {
        return (string) $this->data['rating'];
    }

    /**
     * The score of the customer
     *
     * @return float
     */
    public function getScore(): float
    {
        return (float) $this->data['score'];
    }

    /**
     * The number of total targets
     *
     * @return float
     */
    public function getTargets(): float
    {
        return (float) $this->data['targets'];
    }

    /**
     * The number of scanned targets
     *
     * @return float
     */
    public function getScanCoverage(): float
    {
        return (float) $this->data['scanCoverage'];
    }

    /**
     * The number of in scope targets
     *
     * @return mixed
     */
    public function getInScope(): mixed
    {
        return $this->data['inScope'] ?? null;
    }

    /**
     * The number of out of scope targets
     *
     * @return mixed
     */
    public function getOutOfScope(): mixed
    {
        return $this->data['outOfScope'] ?? null;
    }

    /**
     * The number of vulnerabilities
     *
     * @return mixed
     */
    public function getVulnerabilities(): mixed
    {
        return $this->data['vulnerabilities'] ?? null;
    }

    /**
     * The type of the customer
     *
     * @return string
     */
    public function getType(): string
    {
        return (string) $this->data['type'];
    }
}
