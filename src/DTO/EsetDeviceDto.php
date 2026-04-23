<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class EsetDeviceDto extends AbstractDto
{
    /**
     * Device name
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->data['name'];
    }

    /**
     * Device status
     *
     * @return string
     */
    public function getStatus(): string
    {
        return (string) $this->data['status'];
    }

    /**
     * Module status
     *
     * @return string
     */
    public function getModuleStatus(): string
    {
        return (string) $this->data['moduleStatus'];
    }

    /**
     * Security product name
     *
     * @return string|null
     */
    public function getSecurityProductName(): ?string
    {
        $v = $this->data['securityProductName'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Security product version
     *
     * @return string|null
     */
    public function getSecurityProductVersion(): ?string
    {
        $v = $this->data['securityProductVersion'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Operating system name
     *
     * @return string|null
     */
    public function getOsName(): ?string
    {
        $v = $this->data['osName'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * License public ID
     *
     * @return string|null
     */
    public function getLicensePublicId(): ?string
    {
        $v = $this->data['licensePublicId'] ?? null;
        return $v === null ? null : (string) $v;
    }
}
