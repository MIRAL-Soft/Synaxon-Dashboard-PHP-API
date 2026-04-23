<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class MailstoreCustomerCountDto extends AbstractDto
{
    /**
     * Number of Mailstore instances for this tenant
     *
     * @return float
     */
    public function getCount(): float
    {
        return (float) $this->data['count'];
    }
}
