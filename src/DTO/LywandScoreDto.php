<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class LywandScoreDto extends AbstractDto
{
    /**
     * Total number of targets
     *
     * @return float
     */
    public function getTotalTargets(): float
    {
        return (float) $this->data['totalTargets'];
    }

    /**
     * Number of targets with vulnerabilities
     *
     * @return float
     */
    public function getTargetsWithVulnerabilities(): float
    {
        return (float) $this->data['targetsWithVulnerabilities'];
    }

    /**
     * Score as a decimal (0-1), representing the percentage of targets without vulnerabilities
     *
     * @return float
     */
    public function getScore(): float
    {
        return (float) $this->data['score'];
    }
}
