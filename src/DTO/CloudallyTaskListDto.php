<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CloudallyTaskListDto extends AbstractDto
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
    public function getType(): string
    {
        return (string) $this->required('type');
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return (string) $this->required('status');
    }

    /**
     * @return float
     */
    public function getSize(): float
    {
        return (float) $this->required('size');
    }
}
