<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Exception;

/**
 * Thrown when the API rejects a request due to validation errors (HTTP 400 or 422).
 */
class ValidationException extends SynaxonApiException
{
    /**
     * The API's sub-errors, one readable line per rejected field, for example
     * "limit must not be greater than 100". Empty when the API sent none.
     *
     * @return list<string>
     */
    public function getErrors(): array
    {
        $errors = $this->context['errors'] ?? [];
        if (!is_array($errors)) {
            return [];
        }

        return array_values(array_filter($errors, is_string(...)));
    }
}
