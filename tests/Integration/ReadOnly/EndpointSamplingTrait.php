<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Integration\ReadOnly;

/**
 * Shared helper for read-only integration tests that need a sample entity ID.
 *
 * Each resource group typically exposes a "list" endpoint that returns
 * paginated entities. Tests for endpoints with path parameters (e.g.
 * /v1/customers/{id}) call sampleId() to obtain a real ID drawn from the
 * matching list endpoint. The first ID is cached per test class so the list
 * call is issued at most once per run.
 *
 * If the list response is empty (e.g. nothing has been provisioned yet for
 * the test tenant) the test is skipped with a clear message rather than
 * failing — the absence of test data is not a regression.
 */
trait EndpointSamplingTrait
{
    /** @var array<string, string|null> */
    private static array $sampledIds = [];

    /**
     * Resolve a sample entity ID by invoking $listFn() and returning the first
     * "id" field from the response. Cached per (class, $cacheKey).
     *
     * @param callable(): array<string, mixed>|list<mixed>|null $listFn
     */
    protected function sampleId(string $cacheKey, callable $listFn): string
    {
        $key = static::class . '::' . $cacheKey;

        if (!array_key_exists($key, self::$sampledIds)) {
            $response = $listFn();
            self::$sampledIds[$key] = $this->extractFirstId($response);
        }

        $id = self::$sampledIds[$key];
        if ($id === null) {
            self::markTestSkipped(sprintf(
                'No sample entity available for "%s" — list endpoint returned no items.',
                $cacheKey
            ));
        }

        return $id;
    }

    /**
     * @param array<string, mixed>|list<mixed>|null $response
     */
    private function extractFirstId(array|null $response): ?string
    {
        if ($response === null) {
            return null;
        }
        $items = $response;
        if (isset($response['data']) && is_array($response['data'])) {
            $items = $response['data'];
        }
        if (!is_array($items) || $items === []) {
            return null;
        }
        $first = $items[array_key_first($items)] ?? null;
        if (!is_array($first)) {
            return null;
        }
        $id = $first['id'] ?? $first['_id'] ?? $first['uuid'] ?? null;
        if ($id === null) {
            return null;
        }
        return (string) $id;
    }
}
