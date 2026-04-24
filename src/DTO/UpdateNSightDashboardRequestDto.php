<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class UpdateNSightDashboardRequestDto extends AbstractDto
{
    /**
     * The name of the dashboard
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        $v = $this->data['name'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Set the "name" field. The name of the dashboard
     *
     * @return static
     */
    public function withName(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('name', $value);
    }

    /**
     * First API key
     *
     * @return string|null
     */
    public function getApiKey(): ?string
    {
        $v = $this->data['apiKey'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Set the "apiKey" field. First API key
     *
     * @return static
     */
    public function withApiKey(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('apiKey', $value);
    }

    /**
     * Second API key, for network
     *
     * @return string|null
     */
    public function getApiKeyNetwork(): ?string
    {
        $v = $this->data['apiKeyNetwork'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Set the "apiKeyNetwork" field. Second API key, for network
     *
     * @return static
     */
    public function withApiKeyNetwork(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('apiKeyNetwork', $value);
    }

    /**
     * Default status of the dashboard, boolean
     *
     * @return bool|null
     */
    public function getDefault(): ?bool
    {
        $v = $this->data['default'] ?? null;
        return $v === null ? null : (bool) $v;
    }

    /**
     * Set the "default" field. Default status of the dashboard, boolean
     *
     * @return static
     */
    public function withDefault(?bool $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('default', $value);
    }
}
