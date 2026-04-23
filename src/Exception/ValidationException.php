<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Exception;

/**
 * Thrown when the API rejects a request due to validation errors (HTTP 400 or 422).
 */
class ValidationException extends SynaxonApiException
{
    /**
     * @return array<string, mixed> Field-level errors as returned by the API, when available.
     */
    public function getErrors(): array
    {
        $errors = $this->context['errors'] ?? [];

        return is_array($errors) ? $errors : [];
    }
}
