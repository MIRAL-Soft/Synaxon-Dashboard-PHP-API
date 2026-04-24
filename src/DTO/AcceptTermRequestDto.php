<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class AcceptTermRequestDto extends AbstractDto
{
    /**
     * @return list<string>
     */
    public function getTerms(): array
    {
        return (array) ($this->data['terms'] ?? []);
    }

    /**
     * Set the "terms" field.
     *
     * @return static
     */
    public function withTerms(?array $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('terms', $value);
    }
}
