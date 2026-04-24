<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CreateSupportQueryRequestDto extends AbstractDto
{
    /**
     * The conversation thread ID.
     *
     * @return string
     */
    public function getThreadId(): string
    {
        return (string) $this->data['threadId'];
    }

    /**
     * Set the "threadId" field. The conversation thread ID.
     *
     * @return static
     */
    public function withThreadId(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('threadId', $value);
    }

    /**
     * The question or query to send to the support chatbot
     *
     * @return string
     */
    public function getQuery(): string
    {
        return (string) $this->data['query'];
    }

    /**
     * Set the "query" field. The question or query to send to the support chatbot
     *
     * @return static
     */
    public function withQuery(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('query', $value);
    }
}
