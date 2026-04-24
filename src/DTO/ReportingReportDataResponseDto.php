<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class ReportingReportDataResponseDto extends AbstractDto
{
    /**
     * Product customer counts
     *
     * @return mixed|null
     */
    public function getProductOverview(): mixed
    {
        return $this->data['productOverview'] ?? null;
    }

    /**
     * Customer ranking with scores
     *
     * @return mixed|null
     */
    public function getCustomerRanking(): mixed
    {
        return $this->data['customerRanking'] ?? null;
    }
}
