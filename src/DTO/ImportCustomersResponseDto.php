<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class ImportCustomersResponseDto extends AbstractDto
{
    /**
     * The number of customers created
     *
     * @return float
     */
    public function getCreatedCount(): float
    {
        return (float) $this->required('createdCount');
    }

    /**
     * The number of customers updated
     *
     * @return float
     */
    public function getUpdatedCount(): float
    {
        return (float) $this->required('updatedCount');
    }

    /**
     * The number of customers skipped
     *
     * @return float
     */
    public function getSkippedCount(): float
    {
        return (float) $this->required('skippedCount');
    }

    /**
     * The number of customers failed
     *
     * @return float
     */
    public function getFailedCount(): float
    {
        return (float) $this->required('failedCount');
    }
}
