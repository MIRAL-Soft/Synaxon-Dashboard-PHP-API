<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Http;

/**
 * Minimal HTTP contract used by resource classes.
 *
 * Implementations are responsible for authentication, retries, logging,
 * error-to-exception mapping, and JSON decoding. Resource classes treat this
 * interface as an opaque JSON transport.
 */
interface HttpClientInterface
{
    /**
     * Execute an HTTP request and return the decoded JSON body.
     *
     * @param string                             $method HTTP method (GET, POST, ...).
     * @param string                             $path   Path (appended to the base URI).
     * @param array{query?: array<string, scalar|array<int, scalar>>, body?: array<string, mixed>|null, headers?: array<string, string>} $options
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response (or null for empty/204 responses).
     */
    public function request(string $method, string $path, array $options = []): array|null;
}
