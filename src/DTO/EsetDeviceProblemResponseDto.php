<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class EsetDeviceProblemResponseDto extends AbstractDto
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
     * Tenant ID owning the device problem
     *
     * @return string
     */
    public function getTenantId(): string
    {
        return (string) $this->required('tenantId');
    }

    /**
     * Parent ESET device ID
     *
     * @return string
     */
    public function getParentId(): string
    {
        return (string) $this->required('parentId');
    }

    /**
     * Name of the device
     *
     * @return string
     */
    public function getDeviceName(): string
    {
        return (string) $this->required('deviceName');
    }

    /**
     * Problem summary reported by ESET Protect
     *
     * @return string
     */
    public function getProblem(): string
    {
        return (string) $this->required('problem');
    }

    /**
     * Detailed description of the problem
     *
     * @return string
     */
    public function getProblemDetail(): string
    {
        return (string) $this->required('problemDetail');
    }

    /**
     * Severity of the problem
     *
     * @return string
     */
    public function getSeverity(): string
    {
        return (string) $this->required('severity');
    }
}
