<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CreateNeumeierApiKeyRequestDto extends AbstractDto
{
    /**
     * Lifespan of the generated API key.
     *
     * @return string
     */
    public function getDurationTime(): string
    {
        return (string) $this->required('durationTime');
    }

    /**
     * Set the "durationTime" field. Lifespan of the generated API key.
     *
     * @return static
     */
    public function withDurationTime(?string $value): static
    {
        return $this->with('durationTime', $value);
    }

    /**
     * User-defined title for this API key
     *
     * @return string
     */
    public function getTitle(): string
    {
        return (string) $this->required('title');
    }

    /**
     * Set the "title" field. User-defined title for this API key
     *
     * @return static
     */
    public function withTitle(?string $value): static
    {
        return $this->with('title', $value);
    }
}
