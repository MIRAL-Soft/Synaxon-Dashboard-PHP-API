<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class PermissionResponseDto extends AbstractDto
{
    /**
     * Permission type
     *
     * @return string
     */
    public function getType(): string
    {
        return (string) $this->data['type'];
    }

    /**
     * Permission access level
     *
     * @return string
     */
    public function getAccess(): string
    {
        return (string) $this->data['access'];
    }
}
