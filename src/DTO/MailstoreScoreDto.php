<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class MailstoreScoreDto extends AbstractDto
{
    /**
     * Total number of instances
     *
     * @return float
     */
    public function getTotalInstances(): float
    {
        return (float) $this->data['totalInstances'];
    }

    /**
     * Number of instances with errors
     *
     * @return float
     */
    public function getInstancesWithErrors(): float
    {
        return (float) $this->data['instancesWithErrors'];
    }

    /**
     * Score as a decimal (0-1), representing the percentage of instances without errors
     *
     * @return float
     */
    public function getScore(): float
    {
        return (float) $this->data['score'];
    }
}
