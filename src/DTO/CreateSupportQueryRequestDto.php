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
     * The question or query to send to the support chatbot
     *
     * @return string
     */
    public function getQuery(): string
    {
        return (string) $this->data['query'];
    }
}
