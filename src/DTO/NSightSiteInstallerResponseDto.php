<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class NSightSiteInstallerResponseDto extends AbstractDto
{
    /**
     * URL to the installer
     *
     * @return string
     */
    public function getUrl(): string
    {
        return (string) $this->data['url'];
    }

    /**
     * Download file ID
     *
     * @return string
     */
    public function getFileName(): string
    {
        return (string) $this->data['fileName'];
    }
}
