<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class MessageOptionsResponseDto extends AbstractDto
{
    /**
     * Available tags
     *
     * @return list<string>
     */
    public function getTags(): array
    {
        return (array) ($this->data['tags'] ?? []);
    }
}
