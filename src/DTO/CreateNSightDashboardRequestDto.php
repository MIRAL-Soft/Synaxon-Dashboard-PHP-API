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
        return (string) $this->required('name');
    }

    /**
     * Set the "name" field. The name of the dashboard
     *
     * @return static
     */
    public function withName(?string $value): static
    {
        return $this->with('name', $value);
    }

    /**
     * The dashboard API key
     *
     * @return string
     */
    public function getApiKey(): string
    {
        return (string) $this->required('apiKey');
    }

    /**
     * Set the "apiKey" field. The dashboard API key
     *
     * @return static
     */
    public function withApiKey(?string $value): static
    {
        return $this->with('apiKey', $value);
    }

    /**
     * The dashboard API key for network
     *
     * @return string
     */
    public function getApiKeyNetwork(): string
    {
        return (string) $this->required('apiKeyNetwork');
    }

    /**
     * Set the "apiKeyNetwork" field. The dashboard API key for network
     *
     * @return static
     */
    public function withApiKeyNetwork(?string $value): static
    {
        return $this->with('apiKeyNetwork', $value);
    }

    /**
     * Is default dashboard
     *
     * @return bool
     */
    public function getDefault(): bool
    {
        return (bool) $this->required('default');
    }

    /**
     * Set the "default" field. Is default dashboard
     *
     * @return static
     */
    public function withDefault(?bool $value): static
    {
        return $this->with('default', $value);
    }
}
