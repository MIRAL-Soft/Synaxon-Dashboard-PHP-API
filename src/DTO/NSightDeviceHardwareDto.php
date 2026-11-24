<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class NSightDeviceHardwareDto extends AbstractDto
{
    /**
     * The hardware ID
     *
     * @return float
     */
    public function getHardwareId(): float
    {
        return (float) $this->required('hardwareId');
    }

    /**
     * The name of the hardware
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->required('name');
    }

    /**
     * The type of the hardware
     *
     * @return float
     */
    public function getType(): float
    {
        return (float) $this->required('type');
    }

    /**
     * The manufacturer of the hardware
     *
     * @return string
     */
    public function getManufacturer(): string
    {
        return (string) $this->required('manufacturer');
    }

    /**
     * The details of the hardware
     *
     * @return string
     */
    public function getDetails(): string
    {
        return (string) $this->required('details');
    }

    /**
     * The status of the hardware
     *
     * @return string
     */
    public function getStatus(): string
    {
        return (string) $this->required('status');
    }

    /**
     * The modified status of the hardware
     *
     * @return float
     */
    public function getModified(): float
    {
        return (float) $this->required('modified');
    }

    /**
     * The deleted status of the hardware
     *
     * @return float
     */
    public function getDeleted(): float
    {
        return (float) $this->required('deleted');
    }
}
