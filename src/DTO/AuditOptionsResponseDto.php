<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class AuditOptionsResponseDto extends AbstractDto
{
    /**
     * List of unique entity names available in audit logs
     *
     * @return list<string>
     */
    public function getEntityNames(): array
    {
        return (array) ($this->data['entityNames'] ?? []);
    }
}
