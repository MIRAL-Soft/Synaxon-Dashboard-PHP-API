<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Compat;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;
use miralsoft\synaxon\api\Config\SynaxonConfig;
use miralsoft\synaxon\api\Exception\TransportException;
use miralsoft\synaxon\api\Exception\UnexpectedResponseException;

/**
 * Compares the SYNAXON OpenAPI document with the surface this library
 * version implements.
 *
 * Nothing happens on its own: the spec is fetched only when compare() or
 * fetchSpecJson() is called. How often to check, and whom to tell about a
 * difference, is the calling application's decision.
 *
 *     $report = ApiCompatibility::fromConfig($config)->compare();
 *     if ($report->hasBreakingDrift()) { ... }
 *
 * The spec is public; no credentials are sent.
 */
final class ApiCompatibility
{
    /** Where the Swagger UI loads the document from, relative to the API base URI. */
    public const SPEC_PATH = '/swagger/marketplace-openapi.json';

    public const DEFAULT_SPEC_URL = SynaxonConfig::DEFAULT_BASE_URI . self::SPEC_PATH;

    private const HTTP_METHODS = ['get', 'post', 'put', 'patch', 'delete', 'head', 'options'];

    private readonly ClientInterface $http;

    public function __construct(
        private readonly string $specUrl = self::DEFAULT_SPEC_URL,
        ?ClientInterface $http = null,
        int $timeout = 30,
    ) {
        $this->http = $http ?? new Client(['timeout' => $timeout, 'verify' => true]);
    }

    /**
     * Uses the configured base URI and timeout, so a staging or proxy setup
     * is checked against its own spec.
     */
    public static function fromConfig(SynaxonConfig $config, ?ClientInterface $http = null): self
    {
        return new self($config->getBaseUri() . self::SPEC_PATH, $http, $config->getTimeout());
    }

    public function getSpecUrl(): string
    {
        return $this->specUrl;
    }

    /**
     * Fetch the live document and compare it with this library.
     *
     * @throws TransportException when the document cannot be fetched
     * @throws UnexpectedResponseException when the URL does not serve an OpenAPI document
     */
    public function compare(): CompatibilityReport
    {
        return self::compareSpec(self::decode($this->fetchSpecJson()));
    }

    /**
     * The validated document exactly as the server sent it, for storing.
     * Decoding it into PHP arrays and encoding it again would turn empty
     * objects `{}` into `[]`.
     *
     * @throws TransportException
     * @throws UnexpectedResponseException
     */
    public function fetchSpecJson(): string
    {
        try {
            $response = $this->http->request('GET', $this->specUrl, ['http_errors' => false]);
        } catch (GuzzleException $e) {
            throw new TransportException('Could not fetch the API spec from ' . $this->specUrl . ': ' . $e->getMessage(), 0, $e);
        }

        $status = $response->getStatusCode();
        if ($status !== 200) {
            throw new UnexpectedResponseException(sprintf('The API spec at %s answered HTTP %d.', $this->specUrl, $status), $status);
        }

        // A status code proves nothing here: the Swagger UI answers 200 with
        // HTML for unknown paths. Only a JSON OpenAPI document is accepted.
        $contentType = strtolower($response->getHeaderLine('Content-Type'));
        if (!str_contains($contentType, 'json')) {
            throw new UnexpectedResponseException(sprintf(
                'The API spec at %s is not JSON (Content-Type "%s"); the upstream location has probably changed.',
                $this->specUrl,
                $contentType
            ));
        }

        $body = (string) $response->getBody();
        self::decode($body);

        return $body;
    }

    /**
     * Compare an already loaded OpenAPI document (decoded as arrays) with this
     * library. Works offline, for example against a stored copy.
     *
     * @param array<string, mixed> $spec
     */
    public static function compareSpec(array $spec): CompatibilityReport
    {
        $specOperations = [];
        foreach ((array) ($spec['paths'] ?? []) as $path => $item) {
            if (!is_array($item)) {
                continue;
            }
            foreach (self::HTTP_METHODS as $method) {
                if (isset($item[$method]) && is_array($item[$method])) {
                    $specOperations[] = strtoupper($method) . ' ' . $path;
                }
            }
        }
        $specSchemas = array_map('strval', array_keys((array) ($spec['components']['schemas'] ?? [])));

        $version = $spec['info']['version'] ?? null;

        return new CompatibilityReport(
            specOperationCount: count($specOperations),
            implementedOperationCount: count(ApiSurface::OPERATIONS),
            specSchemaCount: count($specSchemas),
            implementedSchemaCount: count(ApiSurface::SCHEMAS),
            missingOperations: self::sorted(array_diff($specOperations, ApiSurface::OPERATIONS)),
            removedOperations: self::sorted(array_diff(ApiSurface::OPERATIONS, $specOperations)),
            missingSchemas: self::sorted(array_diff($specSchemas, ApiSurface::SCHEMAS)),
            removedSchemas: self::sorted(array_diff(ApiSurface::SCHEMAS, $specSchemas)),
            specVersion: is_string($version) && $version !== '' ? $version : null,
        );
    }

    /**
     * @return array<string, mixed>
     *
     * @throws UnexpectedResponseException
     */
    private static function decode(string $json): array
    {
        try {
            $decoded = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new UnexpectedResponseException('The API spec is not valid JSON: ' . $e->getMessage(), 0, $e);
        }
        if (!is_array($decoded) || !isset($decoded['openapi'], $decoded['paths']) || !is_array($decoded['paths'])) {
            throw new UnexpectedResponseException('The document is JSON but not an OpenAPI specification.');
        }

        /** @var array<string, mixed> $decoded */
        return $decoded;
    }

    /**
     * @param array<array-key, string> $items
     *
     * @return list<string>
     */
    private static function sorted(array $items): array
    {
        $items = array_values($items);
        sort($items, SORT_STRING);

        return $items;
    }
}
