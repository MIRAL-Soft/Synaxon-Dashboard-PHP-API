<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CloudallyErrorDto extends AbstractDto
{
    /**
     * @return string
     */
    public function getCustomerName(): string
    {
        return (string) $this->required('customerName');
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->required('name');
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return (string) $this->required('status');
    }

    /**
     * @return string
     */
    public function getSource(): string
    {
        return (string) $this->required('source');
    }
}
