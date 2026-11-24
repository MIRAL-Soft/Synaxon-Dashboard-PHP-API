<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Support;

use GuzzleHttp\Client;
use JsonException;
use RuntimeException;

/**
 * Fetches the live SYNAXON OpenAPI document.
 *
 * Shared by bin/check-api-compat.php and the live compatibility test so the
 * two cannot disagree about where the spec lives or what counts as one.
 *
 * Since November 2026 the Swagger UI loads the document from a plain JSON file
 * next to the page. The page itself and unknown paths below it answer
 * 200 with HTML, so a status code proves nothing: the response is accepted
 * only when it is JSON and carries an OpenAPI `paths` object.
 */
final class LiveSpec
{
    public const DEFAULT_URL = 'https://api.synaxon.com/marketplace/swagger/marketplace-openapi.json';

    /**
     * @return array<string, mixed>
     *
     * @throws RuntimeException when the URL does not serve an OpenAPI document
     */
    public static function fetch(string $url = self::DEFAULT_URL): array
    {
        $response = new Client(['timeout' => 30, 'http_errors' => false])->request('GET', $url);

        $status = $response->getStatusCode();
        if ($status !== 200) {
            throw new RuntimeException(sprintf('Live spec request to %s answered HTTP %d.', $url, $status));
        }

        $contentType = strtolower($response->getHeaderLine('Content-Type'));
        if (!str_contains($contentType, 'json')) {
            throw new RuntimeException(sprintf(
                'Live spec at %s is not JSON (Content-Type "%s"). The upstream layout has probably changed.',
                $url,
                $contentType,
            ));
        }

        try {
            $decoded = json_decode((string) $response->getBody(), true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new RuntimeException('Live spec is not valid JSON: ' . $e->getMessage(), 0, $e);
        }

        if (!is_array($decoded) || !isset($decoded['openapi'], $decoded['paths']) || !is_array($decoded['paths'])) {
            throw new RuntimeException(sprintf('Response from %s is JSON but not an OpenAPI document.', $url));
        }

        /** @var array<string, mixed> $decoded */
        return $decoded;
    }
}
