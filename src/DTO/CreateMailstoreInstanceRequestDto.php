<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CreateMailstoreInstanceRequestDto extends AbstractDto
{
    /**
     * Customer ID
     *
     * @return float|null
     */
    public function getCustomerId(): ?float
    {
        $v = $this->data['customerId'] ?? null;
        return $v === null ? null : (float) $v;
    }

    /**
     * Instance alias
     *
     * @return string|null
     */
    public function getAlias(): ?string
    {
        $v = $this->data['alias'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Instance display name
     *
     * @return string
     */
    public function getDisplayName(): string
    {
        return (string) $this->data['displayName'];
    }

    /**
     * Instance admin password
     *
     * @return string
     */
    public function getPassword(): string
    {
        return (string) $this->data['password'];
    }
}
