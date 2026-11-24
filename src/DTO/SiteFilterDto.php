<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class SiteFilterDto extends AbstractDto
{
    /**
     * Site IDs to include
     *
     * @return list<string>
     */
    public function getIn(): array
    {
        return array_values(array_map('strval', (array) ($this->data['$in'] ?? [])));
    }

    /**
     * Site IDs to exclude
     *
     * @return list<string>
     */
    public function getNotIn(): array
    {
        return array_values(array_map('strval', (array) ($this->data['$notIn'] ?? [])));
    }
}
