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
        return (string) $this->required('id');
    }

    /**
     * Entity creation date and time
     *
     * @return string
     */
    public function getCreatedAt(): string
    {
        return (string) $this->required('createdAt');
    }

    /**
     * Date and time of last update
     *
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return (string) $this->required('updatedAt');
    }

    /**
     * The lywand customer id this target belongs to
     *
     * @return string
     */
    public function getParentId(): string
    {
        return (string) $this->required('parentId');
    }

    /**
     * The tenant id of the target
     *
     * @return string
     */
    public function getTenantId(): string
    {
        return (string) $this->required('tenantId');
    }

    /**
     * The lywand id of the target
     *
     * @return string
     */
    public function getVendorId(): string
    {
        return (string) $this->required('vendorId');
    }

    /**
     * The name of the target
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->required('name');
    }

    /**
     * The type of the target
     *
     * @return string
     */
    public function getType(): string
    {
        return (string) $this->required('type');
    }

    /**
     * The identifier of the target in Lywand system
     *
     * @return string
     */
    public function getLywandIdentifier(): string
    {
        return (string) $this->required('lywandIdentifier');
    }

    /**
     * Whether the target is in scope
     *
     * @return bool
     */
    public function getInScope(): bool
    {
        return (bool) $this->required('inScope');
    }

    /**
     * The number of vulnerabilities
     *
     * @return float
     */
    public function getVulnerabilities(): float
    {
        return (float) $this->required('vulnerabilities');
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
