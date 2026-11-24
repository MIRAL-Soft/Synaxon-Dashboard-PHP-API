<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class NSightDeviceBackupDto extends AbstractDto
{
    /**
     * The name of the backup solution
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->required('name');
    }

    /**
     * The formatted output of the backup solution
     *
     * @return string
     */
    public function getFormattedOutput(): string
    {
        return (string) $this->required('formattedOutput');
    }

    /**
     * The last check date of the backup solution
     *
     * @return string
     */
    public function getLastCheck(): string
    {
        return (string) $this->required('lastCheck');
    }

    /**
     * The status of the backup solution
     *
     * @return string
     */
    public function getStatus(): string
    {
        return (string) $this->required('status');
    }
}
