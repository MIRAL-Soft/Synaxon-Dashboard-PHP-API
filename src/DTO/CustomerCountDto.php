<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CustomerCountDto extends AbstractDto
{
    /**
     * Number of sites for this tenant
     *
     * @return float
     */
    public function getCount(): float
    {
        return (float) $this->data['count'];
    }
}
