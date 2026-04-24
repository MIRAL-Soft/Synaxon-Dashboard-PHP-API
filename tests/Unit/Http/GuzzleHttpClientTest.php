<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Unit\Http;

use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use miralsoft\synaxon\api\Config\SynaxonConfig;
use miralsoft\synaxon\api\Exception\AuthenticationException;
use miralsoft\synaxon\api\Exception\ServerException;
use miralsoft\synaxon\api\Exception\SynaxonApiException;
use miralsoft\synaxon\api\Http\GuzzleHttpClient;
use PHPUnit\Framework\TestCase;

final class GuzzleHttpClientTest extends TestCase
{
    /**
     * @param list<Response> $responses
     *
     * @param-out list<array{request: Request, response: mixed}> $captured
     */
    private function buildClient(array $responses, array &$captured, int $retries = 0): GuzzleHttpClient
    {
        $captured = [];
        $mock = new MockHandler($responses);
        $stack = HandlerStack::create($mock);
        $stack->push(Middleware::history($captured));

        $config = new SynaxonConfig(
            bearerToken:    'tok',
            baseUri:        'https://example.test/api',
            timeout:        5,
            connectTimeout: 2,
            maxRetries:     $retries,
        );
        $guzzle = new Guzzle([
            'handler' => $stack,
            'base_uri' => 'https://example.test/api/',
            'http_errors' => false,
        ]);

        return new GuzzleHttpClient($config, $guzzle);
    }

    public function testSendsBearerAuthorizationHeader(): void
    {
        $history = [];
        $client = $this->buildClient([new Response(200, [], '{}')], $history);

        $client->request('GET', '/v1/ping');

        self::assertCount(1, $history);
        /** @var Request $req */
        $req = $history[0]['request'];
        self::assertSame('Bearer tok', $req->getHeaderLine('Authorization'));
        self::assertSame('application/json', $req->getHeaderLine('Accept'));
    }

    public function testCallerCannotOverrideAuthorizationHeader(): void
    {
        $history = [];
        $client = $this->buildClient([new Response(200, [], '{}')], $history);

        $client->request('GET', '/v1/ping', [
            'headers' => ['Authorization' => 'Bearer malicious-token', 'X-Custom' => 'ok'],
        ]);

        /** @var Request $req */
        $req = $history[0]['request'];
        self::assertSame('Bearer tok', $req->getHeaderLine('Authorization'));
        self::assertSame('ok', $req->getHeaderLine('X-Custom'));
    }

    public function testMapsHttpStatusToTypedException(): void
    {
        $history = [];
        $client = $this->buildClient(
            [new Response(401, [], '{"message":"bad token"}')],
            $history
        );

        $this->expectException(AuthenticationException::class);
        $client->request('GET', '/v1/private');
    }

    public function testRetriesOn429AndSucceeds(): void
    {
        $history = [];
        $client = $this->buildClient(
            [
                new Response(429, ['Retry-After' => '0'], ''),
                new Response(200, [], '{"ok":true}'),
            ],
            $history,
            retries: 1
        );

        $r = $client->request('GET', '/v1/ping');

        self::assertSame(['ok' => true], $r);
        self::assertCount(2, $history);
    }

    public function testDoesNotRetryOn4xxOtherThan429(): void
    {
        $history = [];
        $client = $this->buildClient(
            [new Response(400, [], '{"message":"bad"}')],
            $history,
            retries: 3
        );

        try {
            $client->request('GET', '/v1/ping');
            self::fail('expected exception');
        } catch (SynaxonApiException) {
            // expected
        }
        self::assertCount(1, $history, 'must not retry 4xx');
    }

    public function testTruncatesOversizeErrorBody(): void
    {
        $big = str_repeat('A', 10_000);
        $history = [];
        $client = $this->buildClient(
            [new Response(500, [], $big)],
            $history
        );

        try {
            $client->request('GET', '/v1/boom');
            self::fail('expected exception');
        } catch (ServerException $e) {
            /** @var string $body */
            $body = $e->getContext()['body'];
            self::assertLessThan(
                10_000,
                strlen($body),
                'oversize body must be truncated to cap'
            );
            self::assertStringEndsWith('... [truncated]', $body);
        }
    }

    public function testRedactHeadersMasksSensitiveHeaders(): void
    {
        $redacted = GuzzleHttpClient::redactHeaders([
            'Authorization' => 'Bearer secret',
            'Cookie' => 'session=xyz',
            'X-API-Key' => 'abc',
            'Accept' => 'application/json',
        ]);

        self::assertSame('***', $redacted['Authorization']);
        self::assertSame('***', $redacted['Cookie']);
        self::assertSame('***', $redacted['X-API-Key']);
        self::assertSame('application/json', $redacted['Accept']);
    }

    public function testWrapsNonJsonResponseWithContentType(): void
    {
        $history = [];
        $client = $this->buildClient(
            [new Response(200, ['Content-Type' => 'text/csv'], "a,b,c\n1,2,3")],
            $history
        );

        $r = $client->request('GET', '/v1/export');
        self::assertIsArray($r);
        self::assertSame('text/csv', $r['_contentType']);
        self::assertSame("a,b,c\n1,2,3", $r['_raw']);
    }

    public function testWrapsJsonScalarResponse(): void
    {
        $history = [];
        $client = $this->buildClient(
            [new Response(200, ['Content-Type' => 'application/json'], 'true')],
            $history
        );

        $r = $client->request('GET', '/v1/check');
        self::assertSame(['value' => true], $r);
    }

    public function testExtractsCorrelationIdFromBody(): void
    {
        $history = [];
        $client = $this->buildClient(
            [new Response(404, [], '{"message":"Not found","correlationId":"abc-123"}')],
            $history
        );

        try {
            $client->request('GET', '/v1/missing');
            self::fail('expected exception');
        } catch (SynaxonApiException $e) {
            self::assertSame('abc-123', $e->getCorrelationId());
        }
    }

    public function testExtractsCorrelationIdFromHeader(): void
    {
        $history = [];
        $client = $this->buildClient(
            [new Response(500, ['X-Correlation-Id' => 'header-xyz'], '{}')],
            $history
        );

        try {
            $client->request('GET', '/v1/boom');
            self::fail('expected exception');
        } catch (SynaxonApiException $e) {
            self::assertSame('header-xyz', $e->getCorrelationId());
        }
    }
}
