<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CreateCustomerReferenceRequestDto extends AbstractDto
{
    /**
     * The reference ID
     *
     * @return string
     */
    public function getReferenceId(): string
    {
        return (string) $this->data['referenceId'];
    }

    /**
     * The system of the reference
     *
     * @return string
     */
    public function getSystem(): string
    {
        return (string) $this->data['system'];
    }
}
