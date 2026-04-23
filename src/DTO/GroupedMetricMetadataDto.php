<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class GroupedMetricMetadataDto extends AbstractDto
{
    /**
     * Entity type (optional, only present when filtering by entityType)
     *
     * @return string|null
     */
    public function getEntityType(): ?string
    {
        $v = $this->data['entityType'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Entity ID (optional, only present when filtering by entityId)
     *
     * @return string|null
     */
    public function getEntityId(): ?string
    {
        $v = $this->data['entityId'] ?? null;
        return $v === null ? null : (string) $v;
    }
}
