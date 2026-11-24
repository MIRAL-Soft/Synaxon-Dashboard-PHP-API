<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class PatchTargetFilterDto extends AbstractDto
{
    /**
     * Device ID filters
     *
     * @return mixed|null
     */
    public function getDeviceIds(): mixed
    {
        return $this->data['deviceIds'] ?? null;
    }

    /**
     * Site ID filters
     *
     * @return mixed|null
     */
    public function getSiteIds(): mixed
    {
        return $this->data['siteIds'] ?? null;
    }
}
