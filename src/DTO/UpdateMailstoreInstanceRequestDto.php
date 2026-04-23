<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class UpdateMailstoreInstanceRequestDto extends AbstractDto
{
    /**
     * Customer ID of customer file
     *
     * @return float|null
     */
    public function getCustomerId(): ?float
    {
        $v = $this->data['customerId'] ?? null;
        return $v === null ? null : (float) $v;
    }

    /**
     * Customer name
     *
     * @return string|null
     */
    public function getDisplayName(): ?string
    {
        $v = $this->data['displayName'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Alias of mailstore instance
     *
     * @return string|null
     */
    public function getAlias(): ?string
    {
        $v = $this->data['alias'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Instance admin password
     *
     * @return string|null
     */
    public function getPassword(): ?string
    {
        $v = $this->data['password'] ?? null;
        return $v === null ? null : (string) $v;
    }
}
