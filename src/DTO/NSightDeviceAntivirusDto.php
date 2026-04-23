<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class NSightDeviceAntivirusDto extends AbstractDto
{
    /**
     * The name of the antivirus solution
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->data['name'];
    }

    /**
     * The version of the antivirus solution
     *
     * @return string
     */
    public function getVersion(): string
    {
        return (string) $this->data['version'];
    }

    /**
     * The last check date of the antivirus solution
     *
     * @return string
     */
    public function getLastCheck(): string
    {
        return (string) $this->data['lastCheck'];
    }

    /**
     * The status of the antivirus solution
     *
     * @return string
     */
    public function getStatus(): string
    {
        return (string) $this->data['status'];
    }
}
