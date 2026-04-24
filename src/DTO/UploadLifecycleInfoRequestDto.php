<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class UploadLifecycleInfoRequestDto extends AbstractDto
{
    /**
     * Lifecycleinfo
     *
     * @return string
     */
    public function getLifecycleInfo(): string
    {
        return (string) $this->data['lifecycleInfo'];
    }

    /**
     * Set the "lifecycleInfo" field. Lifecycleinfo
     *
     * @return static
     */
    public function withLifecycleInfo(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('lifecycleInfo', $value);
    }
}
