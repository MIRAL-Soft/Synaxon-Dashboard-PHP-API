<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Exception;

use RuntimeException;
use Throwable;

/**
 * Base exception for all errors raised by the SYNAXON API client.
 */
class SynaxonApiException extends RuntimeException
{
    /**
     * @param array<string, mixed> $context Arbitrary diagnostic context (never includes secrets).
     */
    public function __construct(
        string $message,
        int $code = 0,
        ?Throwable $previous = null,
        protected readonly array $context = []
    ) {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return array<string, mixed>
     */
    public function getContext(): array
    {
        return $this->context;
    }
}
