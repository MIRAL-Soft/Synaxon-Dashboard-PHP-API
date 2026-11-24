<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class UploadLifecycleInfoRequestDto extends AbstractDto
{
    /**
     * LifecycleInfo
     *
     * @return string
     */
    public function getLifecycleInfo(): string
    {
        return (string) $this->required('lifecycleInfo');
    }

    /**
     * Set the "lifecycleInfo" field. LifecycleInfo
     *
     * @return static
     */
    public function withLifecycleInfo(?string $value): static
    {
        return $this->with('lifecycleInfo', $value);
    }
}
