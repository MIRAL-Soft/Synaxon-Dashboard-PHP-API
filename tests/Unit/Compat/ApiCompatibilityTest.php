<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Unit\Compat;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use miralsoft\synaxon\api\Compat\ApiCompatibility;
use miralsoft\synaxon\api\Compat\ApiSurface;
use miralsoft\synaxon\api\Config\SynaxonConfig;
use miralsoft\synaxon\api\Exception\TransportException;
use miralsoft\synaxon\api\Exception\UnexpectedResponseException;
use PHPUnit\Framework\TestCase;

/**
 * The spec documents in these tests are built from ApiSurface, the surface
 * the library really implements, and then changed in one place, so each test
 * states exactly which difference it expects to be reported.
 */
final class ApiCompatibilityTest extends TestCase
{
    /**
     * @param list<string> $operations
     * @param list<string> $schemas
     *
     * @return array<string, mixed>
     */
    private static function spec(array $operations, array $schemas): array
    {
        $paths = [];
        foreach ($operations as $operation) {
            [$method, $path] = explode(' ', $operation, 2);
            $paths[$path][strtolower($method)] = ['operationId' => 'x'];
        }

        return [
            'openapi' => '3.0.0',
            'info' => ['title' => 'SYNAXON Marketplace API', 'version' => ''],
            'paths' => $paths,
            'components' => ['schemas' => array_fill_keys($schemas, ['type' => 'object'])],
        ];
    }

    public function testIdenticalSurfaceIsCompatible(): void
    {
        $report = ApiCompatibility::compareSpec(self::spec(ApiSurface::OPERATIONS, ApiSurface::SCHEMAS));

        self::assertTrue($report->isCompatible());
        self::assertFalse($report->hasBreakingDrift());
        self::assertSame(count(ApiSurface::OPERATIONS), $report->specOperationCount);
        self::assertNull($report->specVersion, 'an empty info.version is reported as unknown');
    }

    public function testNewUpstreamOperationIsMissingButNotBreaking(): void
    {
        $operations = [...ApiSurface::OPERATIONS, 'GET /v1/brand-new'];

        $report = ApiCompatibility::compareSpec(self::spec($operations, ApiSurface::SCHEMAS));

        self::assertFalse($report->isCompatible());
        self::assertFalse($report->hasBreakingDrift());
        self::assertSame(['GET /v1/brand-new'], $report->missingOperations);
        self::assertSame([], $report->removedOperations);
    }

    public function testOperationRemovedUpstreamIsBreaking(): void
    {
        $removed = ApiSurface::OPERATIONS[0];
        $operations = array_values(array_diff(ApiSurface::OPERATIONS, [$removed]));

        $report = ApiCompatibility::compareSpec(self::spec($operations, ApiSurface::SCHEMAS));

        self::assertTrue($report->hasBreakingDrift());
        self::assertSame([$removed], $report->removedOperations);
    }

    public function testSchemaChangesAreReportedBothWays(): void
    {
        $removed = ApiSurface::SCHEMAS[0];
        $schemas = [...array_values(array_diff(ApiSurface::SCHEMAS, [$removed])), 'BrandNewDto'];

        $report = ApiCompatibility::compareSpec(self::spec(ApiSurface::OPERATIONS, $schemas));

        self::assertSame(['BrandNewDto'], $report->missingSchemas);
        self::assertSame([$removed], $report->removedSchemas);
        self::assertTrue($report->hasBreakingDrift());
    }

    public function testFromConfigUsesTheConfiguredBaseUri(): void
    {
        $config = new SynaxonConfig(bearerToken: 't', baseUri: 'https://staging.example.test/marketplace');

        self::assertSame(
            'https://staging.example.test/marketplace/swagger/marketplace-openapi.json',
            ApiCompatibility::fromConfig($config)->getSpecUrl()
        );
    }

    public function testFetchReturnsTheDocumentUnchangedAndSendsNoCredentials(): void
    {
        $history = [];
        $raw = '{"openapi":"3.0.0","info":{"version":""},"paths":{"/v1/health":{}}}';
        $checker = self::checker([new Response(200, ['Content-Type' => 'application/json; charset=utf-8'], $raw)], $history);

        self::assertSame($raw, $checker->fetchSpecJson(), 'empty objects must stay {}');
        self::assertFalse($history[0]['request']->hasHeader('Authorization'));
    }

    /**
     * The Swagger UI answers 200 with HTML for unknown paths; a status code
     * alone must never count as a spec.
     */
    public function testHtmlIsNotAcceptedAsSpec(): void
    {
        $history = [];
        $checker = self::checker([new Response(200, ['Content-Type' => 'text/html'], '<!doctype html>')], $history);

        $this->expectException(UnexpectedResponseException::class);
        $checker->compare();
    }

    public function testJsonThatIsNoOpenApiDocumentIsRejected(): void
    {
        $history = [];
        $checker = self::checker([new Response(200, ['Content-Type' => 'application/json'], '{"hello":"world"}')], $history);

        $this->expectException(UnexpectedResponseException::class);
        $checker->compare();
    }

    public function testHttpErrorIsReported(): void
    {
        $history = [];
        $checker = self::checker([new Response(404, ['Content-Type' => 'application/json'], '{}')], $history);

        $this->expectException(UnexpectedResponseException::class);
        $checker->compare();
    }

    public function testNetworkFailureIsATransportException(): void
    {
        $history = [];
        $checker = self::checker([new ConnectException('down', new Request('GET', 'https://x.test'))], $history);

        $this->expectException(TransportException::class);
        $checker->compare();
    }

    /**
     * @param list<Response|ConnectException> $responses
     * @param array<int, mixed> $history
     */
    private static function checker(array $responses, array &$history): ApiCompatibility
    {
        $stack = HandlerStack::create(new MockHandler($responses));
        $stack->push(Middleware::history($history));

        return new ApiCompatibility('https://example.test/marketplace/swagger/marketplace-openapi.json', new Client(['handler' => $stack]));
    }
}
