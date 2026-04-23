<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class UpdateSupportQueryRequestDto extends AbstractDto
{
    /**
     * The rating of the chatbot response
     *
     * @return string|null
     */
    public function getRating(): ?string
    {
        $v = $this->data['rating'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * The reason for a negative rating (required when rating is negative)
     *
     * @return string|null
     */
    public function getRatingReason(): ?string
    {
        $v = $this->data['ratingReason'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Optional free text comment for the rating
     *
     * @return string|null
     */
    public function getRatingComment(): ?string
    {
        $v = $this->data['ratingComment'] ?? null;
        return $v === null ? null : (string) $v;
    }
}
