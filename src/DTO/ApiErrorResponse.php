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
        return (float) $this->required('statusCode');
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return (string) $this->required('message');
    }

    /**
     * @return string
     */
    public function getError(): string
    {
        return (string) $this->required('error');
    }

    /**
     * @return string
     */
    public function getCorrelationId(): string
    {
        return (string) $this->required('correlationId');
    }

    /**
     * @return list<string>
     */
    public function getSubErrors(): array
    {
        return array_values(array_map('strval', (array) ($this->data['subErrors'] ?? [])));
    }
}
