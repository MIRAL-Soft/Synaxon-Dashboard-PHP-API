<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class LatestMetricMetadataDto extends AbstractDto
{
    /**
     * Entity type
     *
     * @return string
     */
    public function getEntityType(): string
    {
        return (string) $this->data['entityType'];
    }

    /**
     * Entity ID
     *
     * @return string
     */
    public function getEntityId(): string
    {
        return (string) $this->data['entityId'];
    }
}
