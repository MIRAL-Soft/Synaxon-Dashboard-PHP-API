<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class LywandPartnerResponseDto extends AbstractDto
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
     * The name of the partner
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->data['name'];
    }

    /**
     * The lywand tenantId of the partner
     *
     * @return string
     */
    public function getVendorId(): string
    {
        return (string) $this->data['vendorId'];
    }

    /**
     * The score of the partner
     *
     * @return float
     */
    public function getScore(): float
    {
        return (float) $this->data['score'];
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
     * The type of the partner
     *
     * @return string
     */
    public function getType(): string
    {
        return (string) $this->data['type'];
    }
}
