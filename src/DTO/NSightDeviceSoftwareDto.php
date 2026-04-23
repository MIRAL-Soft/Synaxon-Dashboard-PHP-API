<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class NSightDeviceSoftwareDto extends AbstractDto
{
    /**
     * The name of the software
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->data['name'];
    }

    /**
     * The software ID
     *
     * @return float
     */
    public function getSoftwareId(): float
    {
        return (float) $this->data['softwareId'];
    }

    /**
     * The version of the software
     *
     * @return string
     */
    public function getVersion(): string
    {
        return (string) $this->data['version'];
    }

    /**
     * The install date of the software
     *
     * @return string
     */
    public function getInstallDate(): string
    {
        return (string) $this->data['installDate'];
    }

    /**
     * The deleted status of the software
     *
     * @return float
     */
    public function getDeleted(): float
    {
        return (float) $this->data['deleted'];
    }

    /**
     * The type of the software
     *
     * @return string
     */
    public function getType(): string
    {
        return (string) $this->data['type'];
    }

    /**
     * The modified status of the software
     *
     * @return float
     */
    public function getModified(): float
    {
        return (float) $this->data['modified'];
    }
}
