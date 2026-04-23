<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class ExtendedLywandTargetResponseDto extends AbstractDto
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
     * The lywand customer id this target belongs to
     *
     * @return string
     */
    public function getParentId(): string
    {
        return (string) $this->data['parentId'];
    }

    /**
     * The tenant id of the target
     *
     * @return string
     */
    public function getTenantId(): string
    {
        return (string) $this->data['tenantId'];
    }

    /**
     * The lywand id of the target
     *
     * @return string
     */
    public function getVendorId(): string
    {
        return (string) $this->data['vendorId'];
    }

    /**
     * The name of the target
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->data['name'];
    }

    /**
     * The type of the target
     *
     * @return string
     */
    public function getType(): string
    {
        return (string) $this->data['type'];
    }

    /**
     * The identifier of the target in Lywand system
     *
     * @return string
     */
    public function getLywandIdentifier(): string
    {
        return (string) $this->data['lywandIdentifier'];
    }

    /**
     * Whether the target is in scope
     *
     * @return bool
     */
    public function getInScope(): bool
    {
        return (bool) $this->data['inScope'];
    }

    /**
     * The number of vulnerabilities
     *
     * @return float
     */
    public function getVulnerabilities(): float
    {
        return (float) $this->data['vulnerabilities'];
    }

    /**
     * The highest risk of the target
     *
     * @return float|null
     */
    public function getHighestRisk(): ?float
    {
        $v = $this->data['highestRisk'] ?? null;
        return $v === null ? null : (float) $v;
    }
}
