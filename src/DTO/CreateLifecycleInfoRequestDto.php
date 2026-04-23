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
        return (string) $this->data['name'];
    }

    /**
     * The type of the information
     *
     * @return string
     */
    public function getType(): string
    {
        return (string) $this->data['type'];
    }

    /**
     * The release date of the information
     *
     * @return string
     */
    public function getRelease(): string
    {
        return (string) $this->data['release'];
    }

    /**
     * The end of life date of the information
     *
     * @return string
     */
    public function getEol(): string
    {
        return (string) $this->data['eol'];
    }
}
