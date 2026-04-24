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
     * Set the "ids" field. List of message ids
     *
     * @return static
     */
    public function withIds(?array $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('ids', $value);
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
     * Set the "markedAsRead" field. Mark message as read
     *
     * @return static
     */
    public function withMarkedAsRead(?bool $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('markedAsRead', $value);
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
     * Set the "starred" field. Stares the message
     *
     * @return static
     */
    public function withStarred(?bool $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('starred', $value);
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
     * Set the "important" field. Marks the message as important
     *
     * @return static
     */
    public function withImportant(?bool $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('important', $value);
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

    /**
     * Set the "deleted" field. Marks the message as deleted
     *
     * @return static
     */
    public function withDeleted(?bool $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('deleted', $value);
    }
}
