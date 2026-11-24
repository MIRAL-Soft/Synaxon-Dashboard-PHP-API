<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CloudallyScoreDto extends AbstractDto
{
    /**
     * @return float
     */
    public function getTotalStatuses(): float
    {
        return (float) $this->required('totalStatuses');
    }

    /**
     * @return float
     */
    public function getStatusesWithErrors(): float
    {
        return (float) $this->required('statusesWithErrors');
    }

    /**
     * Score as percentage (0-1)
     *
     * @return float
     */
    public function getScore(): float
    {
        return (float) $this->required('score');
    }
}
