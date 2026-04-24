<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class SupportChatListItemResponseDto extends AbstractDto
{
    /**
     * The conversation thread ID
     *
     * @return string
     */
    public function getThreadId(): string
    {
        return (string) $this->data['threadId'];
    }

    /**
     * Trimmed preview of the first query in the chat thread
     *
     * @return string
     */
    public function getQuery(): string
    {
        return (string) $this->data['query'];
    }
}
