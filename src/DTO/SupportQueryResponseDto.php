<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class SupportQueryResponseDto extends AbstractDto
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
     * The conversation thread ID
     *
     * @return string
     */
    public function getThreadId(): string
    {
        return (string) $this->data['threadId'];
    }

    /**
     * The user query sent to the chatbot
     *
     * @return string
     */
    public function getQuery(): string
    {
        return (string) $this->data['query'];
    }

    /**
     * The HTML formatted response from the chatbot
     *
     * @return string
     */
    public function getResponse(): string
    {
        return (string) $this->data['response'];
    }

    /**
     * The original markdown response from the chatbot
     *
     * @return string
     */
    public function getResponseMarkdown(): string
    {
        return (string) $this->data['responseMarkdown'];
    }

    /**
     * The duration of the query processing in milliseconds
     *
     * @return float
     */
    public function getQueryTime(): float
    {
        return (float) $this->data['queryTime'];
    }

    /**
     * The ID of the user who submitted the query
     *
     * @return string
     */
    public function getUserId(): string
    {
        return (string) $this->data['userId'];
    }

    /**
     * The rating of the chatbot response
     *
     * @return string|null
     */
    public function getRating(): ?string
    {
        $v = $this->data['rating'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * The reason for a negative rating
     *
     * @return string|null
     */
    public function getRatingReason(): ?string
    {
        $v = $this->data['ratingReason'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Optional free text comment for the rating
     *
     * @return string|null
     */
    public function getRatingComment(): ?string
    {
        $v = $this->data['ratingComment'] ?? null;
        return $v === null ? null : (string) $v;
    }
}
