<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class MailstoreArchiveResponseDto extends AbstractDto
{
    /**
     * Archive name
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->data['name'];
    }

    /**
     * Archive size
     *
     * @return float
     */
    public function getSize(): float
    {
        return (float) $this->data['size'];
    }

    /**
     * Number of messages in the archive
     *
     * @return float
     */
    public function getMessageCount(): float
    {
        return (float) $this->data['messageCount'];
    }
}
