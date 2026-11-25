<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Unit\Http;

use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use miralsoft\synaxon\api\Config\SynaxonConfig;
use miralsoft\synaxon\api\Exception\AuthenticationException;
use miralsoft\synaxon\api\Exception\NotFoundException;
use miralsoft\synaxon\api\Exception\RateLimitException;
use miralsoft\synaxon\api\Exception\ServerException;
use miralsoft\synaxon\api\Exception\SynaxonApiException;
use miralsoft\synaxon\api\Exception\TransportException;
use miralsoft\synaxon\api\Exception\ValidationException;
use miralsoft\synaxon\api\Http\GuzzleHttpClient;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Psr\Log\AbstractLogger;

final class GuzzleHttpClientTest extends TestCase
{
    /**
     * @param list<Response|ConnectException> $responses
     *
     * @param-out list<array{request: Request, response: mixed}> $captured
     */
    private function buildClient(
        array $responses,
        array &$captured,
        int $retries = 0,
        ?AbstractLogger $logger = null,
    ): GuzzleHttpClient {
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

        return new GuzzleHttpClient($config, $guzzle, $logger);
    }

    private static function connectError(string $method): ConnectException
    {
        return new ConnectException('timed out', new Request($method, 'https://example.test/api/v1/x'));
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

    public function testRetriesIdempotentMethodOn5xx(): void
    {
        $history = [];
        $client = $this->buildClient(
            [new Response(503, [], ''), new Response(200, [], '{"ok":true}')],
            $history,
            retries: 1
        );

        self::assertSame(['ok' => true], $client->request('GET', '/v1/ping'));
        self::assertCount(2, $history);
    }

    /**
     * A POST that failed upstream may already have created its record, so a
     * repeat could create a second one. It is reported, not repeated.
     */
    public function testDoesNotRetryPostOn5xx(): void
    {
        $history = [];
        $client = $this->buildClient(
            [new Response(500, [], '{}'), new Response(201, [], '{"id":"second"}')],
            $history,
            retries: 3
        );

        try {
            $client->request('POST', '/v1/customers', ['body' => ['name' => 'x']]);
            self::fail('expected exception');
        } catch (ServerException) {
            // expected
        }
        self::assertCount(1, $history, 'POST must not be repeated after a 5xx');
    }

    public function testDoesNotRetryPatchOn5xx(): void
    {
        $history = [];
        $client = $this->buildClient(
            [new Response(502, [], ''), new Response(200, [], '{}')],
            $history,
            retries: 3
        );

        try {
            $client->request('PATCH', '/v1/customers/1', ['body' => ['name' => 'x']]);
            self::fail('expected exception');
        } catch (ServerException) {
            // expected
        }
        self::assertCount(1, $history);
    }

    /**
     * A 429 means the server refused the request before processing it, so
     * repeating a POST is safe.
     */
    public function testRetriesPostOn429(): void
    {
        $history = [];
        $client = $this->buildClient(
            [new Response(429, ['Retry-After' => '0'], ''), new Response(201, [], '{"id":"1"}')],
            $history,
            retries: 1
        );

        self::assertSame(['id' => '1'], $client->request('POST', '/v1/customers', ['body' => []]));
        self::assertCount(2, $history);
    }

    public function testRetriesGetOnConnectionError(): void
    {
        $history = [];
        $client = $this->buildClient(
            [self::connectError('GET'), new Response(200, [], '{"ok":true}')],
            $history,
            retries: 1
        );

        self::assertSame(['ok' => true], $client->request('GET', '/v1/ping'));
    }

    public function testDoesNotRetryPostOnConnectionError(): void
    {
        $history = [];
        $mock = [self::connectError('POST'), new Response(201, [], '{"id":"second"}')];
        $client = $this->buildClient($mock, $history, retries: 3);

        try {
            $client->request('POST', '/v1/customers', ['body' => []]);
            self::fail('expected exception');
        } catch (TransportException) {
            // expected
        }
        // The history middleware records failed transfers too: the POST went out once.
        self::assertCount(1, $history);
    }

    public function testLogsUnauthorizedAsWarningWithoutCredentials(): void
    {
        $logger = new class () extends AbstractLogger {
            /** @var list<array{level: mixed, message: string, context: array<mixed>}> */
            public array $records = [];

            public function log($level, \Stringable|string $message, array $context = []): void
            {
                $this->records[] = ['level' => $level, 'message' => (string) $message, 'context' => $context];
            }
        };
        $history = [];
        $client = $this->buildClient([new Response(401, [], '{"message":"no"}')], $history, 0, $logger);

        try {
            $client->request('GET', '/v1/private');
            self::fail('expected exception');
        } catch (AuthenticationException) {
            // expected
        }

        self::assertCount(1, $logger->records);
        self::assertSame('warning', $logger->records[0]['level']);
        self::assertStringNotContainsString('tok', (string) json_encode($logger->records[0]['context']));
    }

    /**
     * Without advice from the server the exception must say so with null,
     * not with 0, which a caller would read as "retry immediately".
     */
    #[DataProvider('retryAfterProvider')]
    public function testRateLimitExceptionReportsRetryAfter(array $headers, ?int $expectedMin, ?int $expectedMax): void
    {
        $history = [];
        $client = $this->buildClient([new Response(429, $headers, '')], $history);

        try {
            $client->request('GET', '/v1/ping');
            self::fail('expected exception');
        } catch (RateLimitException $e) {
            $retryAfter = $e->getRetryAfter();
            if ($expectedMin === null) {
                self::assertNull($retryAfter);

                return;
            }
            self::assertNotNull($retryAfter);
            self::assertGreaterThanOrEqual($expectedMin, $retryAfter);
            self::assertLessThanOrEqual((int) $expectedMax, $retryAfter);
        }
    }

    /**
     * @return iterable<string, array{array<string, string>, ?int, ?int}>
     */
    public static function retryAfterProvider(): iterable
    {
        yield 'absent' => [[], null, null];
        yield 'delay seconds' => [['Retry-After' => '7'], 7, 7];
        yield 'http date' => [['Retry-After' => gmdate(DATE_RFC7231, time() + 60)], 55, 60];
        yield 'date in the past' => [['Retry-After' => gmdate(DATE_RFC7231, time() - 60)], 0, 0];
        yield 'garbage' => [['Retry-After' => 'soon'], null, null];
        yield 'fraction is not delay-seconds' => [['Retry-After' => '1.5'], null, null];
    }

    /**
     * The spec declares list parameters with the default form/explode style
     * (repeated keys) and boolean parameters as true/false.
     */
    public function testEncodesQueryListsAsRepeatedKeysAndBooleansAsWords(): void
    {
        $history = [];
        $client = $this->buildClient([new Response(200, [], '{}')], $history);

        $client->request('GET', '/v1/x', ['query' => ['status' => ['a', 'b c'], 'isOnline' => false, 'page' => 2]]);

        self::assertSame('status=a&status=b%20c&isOnline=false&page=2', $history[0]['request']->getUri()->getQuery());
    }

    /**
     * The body is the ApiErrorResponse example from docs/openapi.json, the
     * same shape the live API returned on 2026-11-25 for limit=1000.
     */
    public function testValidationExceptionExposesSubErrorsAndCode(): void
    {
        $history = [];
        $body = '{"statusCode":400,"message":"Validation error","error":"GENERIC.VALIDATION_ERROR",'
            . '"correlationId":"DMyg0Zzu7kjGdX2Ai0UtX",'
            . '"subErrors":["refreshToken must be longer than or equal to 10 characters."]}';
        $client = $this->buildClient([new Response(400, ['Content-Type' => 'application/json'], $body)], $history);

        try {
            $client->request('POST', '/v1/auth/refresh', ['body' => ['refreshToken' => 'x']]);
            self::fail('expected exception');
        } catch (ValidationException $e) {
            self::assertSame(['refreshToken must be longer than or equal to 10 characters.'], $e->getErrors());
            self::assertSame('GENERIC.VALIDATION_ERROR', $e->getErrorCode());
            self::assertSame('DMyg0Zzu7kjGdX2Ai0UtX', $e->getCorrelationId());
        }
    }

    public function testNotFoundExposesErrorCode(): void
    {
        $history = [];
        $body = '{"statusCode":404,"message":"Not found","error":"GENERIC.NOT_FOUND"}';
        $client = $this->buildClient([new Response(404, ['Content-Type' => 'application/json'], $body)], $history);

        try {
            $client->request('GET', '/v1/customers/1');
            self::fail('expected exception');
        } catch (NotFoundException $e) {
            self::assertSame('GENERIC.NOT_FOUND', $e->getErrorCode());
            self::assertSame([], $e->getContext()['errors'] ?? []);
        }
    }

    public function testSendsConfiguredAcceptLanguage(): void
    {
        $history = [];
        $stack = HandlerStack::create(new MockHandler([new Response(200, [], '{}'), new Response(200, [], '{}')]));
        $stack->push(Middleware::history($history));
        $guzzle = new Guzzle(['handler' => $stack, 'base_uri' => 'https://example.test/api/', 'http_errors' => false]);

        new GuzzleHttpClient(new SynaxonConfig(bearerToken: 't', baseUri: 'https://example.test/api', acceptLanguage: 'de'), $guzzle)
            ->request('GET', '/v1/x');
        new GuzzleHttpClient(new SynaxonConfig(bearerToken: 't', baseUri: 'https://example.test/api'), $guzzle)
            ->request('GET', '/v1/x');

        self::assertSame('de', $history[0]['request']->getHeaderLine('Accept-Language'));
        self::assertFalse($history[1]['request']->hasHeader('Accept-Language'));
    }

    public function testSendsEmptyJsonBodyAsObject(): void
    {
        $history = [];
        $client = $this->buildClient([new Response(200, [], '{}')], $history);

        $client->request('POST', '/v1/x', ['body' => []]);

        self::assertSame('{}', (string) $history[0]['request']->getBody());
        self::assertSame('application/json', $history[0]['request']->getHeaderLine('Content-Type'));
    }

    public function testSendsFormBody(): void
    {
        $history = [];
        $client = $this->buildClient([new Response(200, [], '{}')], $history);

        $client->request('POST', '/v1/auth/token', [
            'body' => ['grant_type' => 'client_credentials', 'scope' => 'sys-app'],
            'bodyFormat' => GuzzleHttpClient::BODY_FORM,
        ]);

        self::assertSame('application/x-www-form-urlencoded', $history[0]['request']->getHeaderLine('Content-Type'));
        self::assertSame('grant_type=client_credentials&scope=sys-app', (string) $history[0]['request']->getBody());
    }

    public function testSendsMultipartBodyWithFile(): void
    {
        $history = [];
        $client = $this->buildClient([new Response(200, [], '{}')], $history);

        $client->request('PUT', '/v1/tenants/1/logo', [
            'body' => ['file' => ['contents' => 'PNGDATA', 'filename' => 'logo.png'], 'note' => 'x'],
            'bodyFormat' => GuzzleHttpClient::BODY_MULTIPART,
        ]);

        $request = $history[0]['request'];
        self::assertStringStartsWith('multipart/form-data; boundary=', $request->getHeaderLine('Content-Type'));
        $body = (string) $request->getBody();
        self::assertStringContainsString('name="file"; filename="logo.png"', $body);
        self::assertStringContainsString('PNGDATA', $body);
        self::assertStringContainsString('name="note"', $body);
    }

    /**
     * PSR-7 quotes an invalid header value in its exception message. The
     * library must not pass that message (and with it the credential) on.
     */
    public function testInvalidHeaderValueDoesNotLeakIntoException(): void
    {
        $history = [];
        $client = $this->buildClient([new Response(200, [], '{}')], $history);

        try {
            $client->request('GET', '/v1/x', ['headers' => ['X-Trace' => "abc\r\nsecret-value"]]);
            self::fail('expected exception');
        } catch (TransportException $e) {
            self::assertStringNotContainsString('secret-value', $e->getMessage());
            self::assertNull($e->getPrevious());
        }
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
