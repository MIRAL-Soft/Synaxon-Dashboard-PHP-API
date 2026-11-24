<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class SiteTargetSummaryResponseDto extends AbstractDto
{
    /**
     * Site ID
     *
     * @return string
     */
    public function getSiteId(): string
    {
        return (string) $this->required('siteId');
    }

    /**
     * Site name
     *
     * @return string
     */
    public function getSiteName(): string
    {
        return (string) $this->required('siteName');
    }

    /**
     * Number of devices in this site
     *
     * @return float
     */
    public function getDeviceCount(): float
    {
        return (float) $this->required('deviceCount');
    }
}
