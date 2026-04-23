<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class ApiErrorResponse extends AbstractDto
{
    /**
     * @return float
     */
    public function getStatusCode(): float
    {
        return (float) $this->data['statusCode'];
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return (string) $this->data['message'];
    }

    /**
     * @return string
     */
    public function getError(): string
    {
        return (string) $this->data['error'];
    }

    /**
     * @return string
     */
    public function getCorrelationId(): string
    {
        return (string) $this->data['correlationId'];
    }

    /**
     * @return list<string>
     */
    public function getSubErrors(): array
    {
        return (array) ($this->data['subErrors'] ?? []);
    }
}
