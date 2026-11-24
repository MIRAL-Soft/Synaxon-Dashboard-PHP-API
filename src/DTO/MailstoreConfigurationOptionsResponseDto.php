<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class MailstoreConfigurationOptionsResponseDto extends AbstractDto
{
    /**
     * List of available hosts
     *
     * @return list<string>
     */
    public function getHosts(): array
    {
        return array_values(array_map('strval', (array) ($this->data['hosts'] ?? [])));
    }
}
