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
        return (string) $this->data['name'];
    }

    /**
     * The formatted output of the backup solution
     *
     * @return string
     */
    public function getFormattedOutput(): string
    {
        return (string) $this->data['formattedOutput'];
    }

    /**
     * The last check date of the backup solution
     *
     * @return string
     */
    public function getLastCheck(): string
    {
        return (string) $this->data['lastCheck'];
    }

    /**
     * The status of the backup solution
     *
     * @return string
     */
    public function getStatus(): string
    {
        return (string) $this->data['status'];
    }
}
