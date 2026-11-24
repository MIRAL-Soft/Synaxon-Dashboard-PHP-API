<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class AcronisErrorDto extends AbstractDto
{
    /**
     * Device name with error
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->required('name');
    }

    /**
     * Device type
     *
     * @return string
     */
    public function getType(): string
    {
        return (string) $this->required('type');
    }

    /**
     * Error status
     *
     * @return string
     */
    public function getStatus(): string
    {
        return (string) $this->required('status');
    }
}
