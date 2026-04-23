<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class UpdateLifecycleInfoRequestDto extends AbstractDto
{
    /**
     * The name of the information
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        $v = $this->data['name'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * The type of the information
     *
     * @return string|null
     */
    public function getType(): ?string
    {
        $v = $this->data['type'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * The release date of the information
     *
     * @return string|null
     */
    public function getRelease(): ?string
    {
        $v = $this->data['release'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * The end of life date of the information
     *
     * @return string|null
     */
    public function getEol(): ?string
    {
        $v = $this->data['eol'] ?? null;
        return $v === null ? null : (string) $v;
    }
}
