<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Unit\Support;

use LogicException;
use miralsoft\synaxon\api\Tests\Support\MockHttpClient;
use miralsoft\synaxon\api\Tests\Support\ReadOnlyHttpClient;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

/**
 * The guard of the live integration suite must refuse every writing method
 * before the request reaches the transport.
 */
final class ReadOnlyHttpClientTest extends TestCase
{
    public function testPassesReadsThrough(): void
    {
        $inner = new MockHttpClient()->queue(['ok' => true]);

        self::assertSame(['ok' => true], new ReadOnlyHttpClient($inner)->request('GET', '/v1/x'));
        self::assertSame('GET', $inner->lastRequest()['method'] ?? null);
    }

    #[DataProvider('writingMethods')]
    public function testRefusesWritesBeforeSending(string $method): void
    {
        $inner = new MockHttpClient();

        try {
            new ReadOnlyHttpClient($inner)->request($method, '/v1/customers', ['body' => []]);
            self::fail('expected LogicException');
        } catch (LogicException) {
            self::assertNull($inner->lastRequest(), 'the request must not reach the transport');
        }
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function writingMethods(): iterable
    {
        foreach (['POST', 'PUT', 'PATCH', 'DELETE', 'post'] as $m) {
            yield $m => [$m];
        }
    }
}
