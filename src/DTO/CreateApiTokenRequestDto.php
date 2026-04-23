<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CreateApiTokenRequestDto extends AbstractDto
{
    /**
     * Grant type
     *
     * @return string
     */
    public function getGrantType(): string
    {
        return (string) $this->data['grant_type'];
    }

    /**
     * Scope
     *
     * @return string
     */
    public function getScope(): string
    {
        return (string) $this->data['scope'];
    }
}
