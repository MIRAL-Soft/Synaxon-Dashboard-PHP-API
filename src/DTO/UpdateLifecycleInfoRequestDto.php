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
     * Set the "name" field. The name of the information
     *
     * @return static
     */
    public function withName(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('name', $value);
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
     * Set the "type" field. The type of the information
     *
     * @return static
     */
    public function withType(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('type', $value);
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
     * Set the "release" field. The release date of the information
     *
     * @return static
     */
    public function withRelease(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('release', $value);
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

    /**
     * Set the "eol" field. The end of life date of the information
     *
     * @return static
     */
    public function withEol(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('eol', $value);
    }
}
