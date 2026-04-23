<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Exception;

/**
 * Thrown when the API rate limit has been exceeded (HTTP 429).
 */
class RateLimitException extends SynaxonApiException
{
    public function getRetryAfter(): ?int
    {
        $value = $this->context['retry_after'] ?? null;

        return is_int($value) ? $value : null;
    }
}
