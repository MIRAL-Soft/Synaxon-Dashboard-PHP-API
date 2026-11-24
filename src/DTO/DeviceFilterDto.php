<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class DeviceFilterDto extends AbstractDto
{
    /**
     * Device IDs to include
     *
     * @return list<float>
     */
    public function getIn(): array
    {
        return array_values(array_map('floatval', (array) ($this->data['$in'] ?? [])));
    }

    /**
     * Device IDs to exclude
     *
     * @return list<float>
     */
    public function getNotIn(): array
    {
        return array_values(array_map('floatval', (array) ($this->data['$notIn'] ?? [])));
    }
}
