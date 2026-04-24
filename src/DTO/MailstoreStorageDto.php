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
        return (float) $this->data['totalArchives'];
    }

    /**
     * Total number of archived messages
     *
     * @return float
     */
    public function getTotalMessages(): float
    {
        return (float) $this->data['totalMessages'];
    }

    /**
     * Total storage size in bytes
     *
     * @return float
     */
    public function getTotalSize(): float
    {
        return (float) $this->data['totalSize'];
    }

    /**
     * Total number of additional users
     *
     * @return float
     */
    public function getTotalAdditionalUsers(): float
    {
        return (float) $this->data['totalAdditionalUsers'];
    }

    /**
     * Total additional storage in bytes
     *
     * @return float
     */
    public function getTotalAdditionalStorage(): float
    {
        return (float) $this->data['totalAdditionalStorage'];
    }
}
