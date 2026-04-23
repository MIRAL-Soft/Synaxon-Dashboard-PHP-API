<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class UploadLifecycleInfoRequestDto extends AbstractDto
{
    /**
     * Lifecycleinfo
     *
     * @return string
     */
    public function getLifecycleInfo(): string
    {
        return (string) $this->data['lifecycleInfo'];
    }
}
