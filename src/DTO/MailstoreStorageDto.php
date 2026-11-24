<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class MailstoreStorageDto extends AbstractDto
{
    /**
     * Total number of archives
     *
     * @return float
     */
    public function getTotalArchives(): float
    {
        return (float) $this->required('totalArchives');
    }

    /**
     * Total number of archived messages
     *
     * @return float
     */
    public function getTotalMessages(): float
    {
        return (float) $this->required('totalMessages');
    }

    /**
     * Total storage size in bytes
     *
     * @return float
     */
    public function getTotalSize(): float
    {
        return (float) $this->required('totalSize');
    }

    /**
     * Total number of additional users
     *
     * @return float
     */
    public function getTotalAdditionalUsers(): float
    {
        return (float) $this->required('totalAdditionalUsers');
    }

    /**
     * Total additional storage in bytes
     *
     * @return float
     */
    public function getTotalAdditionalStorage(): float
    {
        return (float) $this->required('totalAdditionalStorage');
    }
}
