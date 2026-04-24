<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class NSightDeviceTakeControlUrlResponseDto extends AbstractDto
{
    /**
     * URL to take control of the device
     *
     * @return string
     */
    public function getUrl(): string
    {
        return (string) $this->data['url'];
    }
}
