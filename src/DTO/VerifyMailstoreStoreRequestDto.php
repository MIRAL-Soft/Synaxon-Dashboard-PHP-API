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
     * Store ID
     *
     * @return string
     */
    public function getStoreId(): string
    {
        return (string) $this->data['storeId'];
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
}
