<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CreateLifecycleInfoRequestDto extends AbstractDto
{
    /**
     * The name of the information
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->required('name');
    }

    /**
     * Set the "name" field. The name of the information
     *
     * @return static
     */
    public function withName(?string $value): static
    {
        return $this->with('name', $value);
    }

    /**
     * The type of the information
     *
     * @return string
     */
    public function getType(): string
    {
        return (string) $this->required('type');
    }

    /**
     * Set the "type" field. The type of the information
     *
     * @return static
     */
    public function withType(?string $value): static
    {
        return $this->with('type', $value);
    }

    /**
     * The release date of the information
     *
     * @return string
     */
    public function getRelease(): string
    {
        return (string) $this->required('release');
    }

    /**
     * Set the "release" field. The release date of the information
     *
     * @return static
     */
    public function withRelease(?string $value): static
    {
        return $this->with('release', $value);
    }

    /**
     * The end of life date of the information
     *
     * @return string
     */
    public function getEol(): string
    {
        return (string) $this->required('eol');
    }

    /**
     * Set the "eol" field. The end of life date of the information
     *
     * @return static
     */
    public function withEol(?string $value): static
    {
        return $this->with('eol', $value);
    }
}
