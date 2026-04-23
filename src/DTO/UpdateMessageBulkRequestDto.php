<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class UpdateMessageBulkRequestDto extends AbstractDto
{
    /**
     * List of message ids
     *
     * @return list<string>
     */
    public function getIds(): array
    {
        return (array) ($this->data['ids'] ?? []);
    }

    /**
     * Mark message as read
     *
     * @return bool|null
     */
    public function getMarkedAsRead(): ?bool
    {
        $v = $this->data['markedAsRead'] ?? null;
        return $v === null ? null : (bool) $v;
    }

    /**
     * Stares the message
     *
     * @return bool|null
     */
    public function getStarred(): ?bool
    {
        $v = $this->data['starred'] ?? null;
        return $v === null ? null : (bool) $v;
    }

    /**
     * Marks the message as important
     *
     * @return bool|null
     */
    public function getImportant(): ?bool
    {
        $v = $this->data['important'] ?? null;
        return $v === null ? null : (bool) $v;
    }

    /**
     * Marks the message as deleted
     *
     * @return bool|null
     */
    public function getDeleted(): ?bool
    {
        $v = $this->data['deleted'] ?? null;
        return $v === null ? null : (bool) $v;
    }
}
