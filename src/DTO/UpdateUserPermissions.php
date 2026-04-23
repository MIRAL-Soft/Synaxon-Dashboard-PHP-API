<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class UpdateUserPermissions extends AbstractDto
{
    /**
     * User permissions
     *
     * @return string
     */
    public function getType(): string
    {
        return (string) $this->data['type'];
    }

    /**
     * User permissions access
     *
     * @return string
     */
    public function getAccess(): string
    {
        return (string) $this->data['access'];
    }
}
