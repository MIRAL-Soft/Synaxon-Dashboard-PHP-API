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
     * Default status of the dashboard, boolean
     *
     * @return bool|null
     */
    public function getDefault(): ?bool
    {
        $v = $this->data['default'] ?? null;
        return $v === null ? null : (bool) $v;
    }
}
