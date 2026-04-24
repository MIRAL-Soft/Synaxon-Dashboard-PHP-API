<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class VerifyMailstoreStoreRequestDto extends AbstractDto
{
    /**
     * Instance ID
     *
     * @return string
     */
    public function getInstanceId(): string
    {
        return (string) $this->data['instanceId'];
    }

    /**
     * Set the "instanceId" field. Instance ID
     *
     * @return static
     */
    public function withInstanceId(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('instanceId', $value);
    }

    /**
     * Store ID
     *
     * @return string
     */
    public function getStoreId(): string
    {
        return (string) $this->data['storeId'];
    }

    /**
     * Set the "storeId" field. Store ID
     *
     * @return static
     */
    public function withStoreId(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('storeId', $value);
    }

    /**
     * Include indexes
     *
     * @return bool
     */
    public function getIncludeIndexes(): bool
    {
        return (bool) $this->data['includeIndexes'];
    }

    /**
     * Set the "includeIndexes" field. Include indexes
     *
     * @return static
     */
    public function withIncludeIndexes(?bool $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('includeIndexes', $value);
    }
}
