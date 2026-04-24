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
     * Set the "rating" field. The rating of the chatbot response
     *
     * @return static
     */
    public function withRating(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('rating', $value);
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
     * Set the "ratingReason" field. The reason for a negative rating (required when rating is negative)
     *
     * @return static
     */
    public function withRatingReason(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('ratingReason', $value);
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

    /**
     * Set the "ratingComment" field. Optional free text comment for the rating
     *
     * @return static
     */
    public function withRatingComment(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('ratingComment', $value);
    }
}
