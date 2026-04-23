<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class UpdateTenantLogoRequestDto extends AbstractDto
{
    /**
     * Tenant logo
     *
     * @return string
     */
    public function getLogo(): string
    {
        return (string) $this->data['logo'];
    }
}
