<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CreateNSightDashboardRequestDto extends AbstractDto
{
    /**
     * The name of the dashboard
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->data['name'];
    }

    /**
     * The dashboard API key
     *
     * @return string
     */
    public function getApiKey(): string
    {
        return (string) $this->data['apiKey'];
    }

    /**
     * The dashboard API key for network
     *
     * @return string
     */
    public function getApiKeyNetwork(): string
    {
        return (string) $this->data['apiKeyNetwork'];
    }

    /**
     * Is default dashboard
     *
     * @return bool
     */
    public function getDefault(): bool
    {
        return (bool) $this->data['default'];
    }
}
