<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class MailstoreArchiveDto extends AbstractDto
{
    /**
     * Instance name
     *
     * @return string
     */
    public function getInstanceName(): string
    {
        return (string) $this->data['instanceName'];
    }

    /**
     * Archive name
     *
     * @return string
     */
    public function getArchiveName(): string
    {
        return (string) $this->data['archiveName'];
    }
}
