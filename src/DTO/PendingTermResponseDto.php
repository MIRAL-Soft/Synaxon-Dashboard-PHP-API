<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class PendingTermResponseDto extends AbstractDto
{
    /**
     * @return string
     */
    public function getType(): string
    {
        return (string) $this->data['type'];
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return (string) $this->data['url'];
    }
}
