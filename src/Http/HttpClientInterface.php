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
     * @param string $method HTTP method (GET, POST, ...).
     * @param string $path Path (appended to the base URI).
     *                     Options:
     *                     - query: parameters; a list becomes repeated keys, booleans `true` / `false`.
     *                     - body: request body, encoded as bodyFormat says.
     *                     - bodyFormat: `json` (default), `form` (x-www-form-urlencoded) or
     *                     `multipart` (multipart/form-data, for file uploads).
     *                     - headers: extra headers; Authorization and Host cannot be overridden.
     * @param array{query?: array<string, scalar|array<int, scalar>>, body?: array<string, mixed>|null, bodyFormat?: string, headers?: array<string, string>} $options
     *
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response (or null for empty/204 responses).
     */
    public function request(string $method, string $path, array $options = []): array|null;
}
