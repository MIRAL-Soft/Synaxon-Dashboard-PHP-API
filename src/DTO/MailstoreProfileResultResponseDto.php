<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class MailstoreProfileResultResponseDto extends AbstractDto
{
    /**
     * Entity unique identifier
     *
     * @return string
     */
    public function getId(): string
    {
        return (string) $this->data['id'];
    }

    /**
     * Entity creation date and time
     *
     * @return string
     */
    public function getCreatedAt(): string
    {
        return (string) $this->data['createdAt'];
    }

    /**
     * Date and time of last update
     *
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return (string) $this->data['updatedAt'];
    }

    /**
     * When the archiving run started
     *
     * @return string
     */
    public function getStartedAt(): string
    {
        return (string) $this->data['startedAt'];
    }

    /**
     * When the archiving run completed
     *
     * @return string|null
     */
    public function getCompletedAt(): ?string
    {
        $v = $this->data['completedAt'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Result status of the run
     *
     * @return string
     */
    public function getStatus(): string
    {
        return (string) $this->data['status'];
    }

    /**
     * Number of messages archived during the run
     *
     * @return float
     */
    public function getMessagesArchived(): float
    {
        return (float) $this->data['messagesArchived'];
    }
}
