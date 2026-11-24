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
        return (string) $this->required('name');
    }

    /**
     * The software ID
     *
     * @return float
     */
    public function getSoftwareId(): float
    {
        return (float) $this->required('softwareId');
    }

    /**
     * The version of the software
     *
     * @return string
     */
    public function getVersion(): string
    {
        return (string) $this->required('version');
    }

    /**
     * The install date of the software
     *
     * @return string
     */
    public function getInstallDate(): string
    {
        return (string) $this->required('installDate');
    }

    /**
     * The deleted status of the software
     *
     * @return float
     */
    public function getDeleted(): float
    {
        return (float) $this->required('deleted');
    }

    /**
     * The type of the software
     *
     * @return string
     */
    public function getType(): string
    {
        return (string) $this->required('type');
    }

    /**
     * The modified status of the software
     *
     * @return float
     */
    public function getModified(): float
    {
        return (float) $this->required('modified');
    }
}
