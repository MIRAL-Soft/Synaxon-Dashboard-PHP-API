<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Unit\Config;

use InvalidArgumentException;
use miralsoft\synaxon\api\Config\SynaxonConfig;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class SynaxonConfigTest extends TestCase
{
    public function testDefaults(): void
    {
        $cfg = new SynaxonConfig(bearerToken: 'tok');
        self::assertSame('https://api.synaxon.com/marketplace', $cfg->getBaseUri());
        self::assertSame(30, $cfg->getTimeout());
        self::assertSame(10, $cfg->getConnectTimeout());
        self::assertSame(3, $cfg->getMaxRetries());
        self::assertTrue($cfg->hasAuth());
    }

    public function testRejectsInvalidTimeout(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new SynaxonConfig(bearerToken: 'tok', timeout: 0);
    }

    public function testRejectsBasicUserWithoutPassword(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new SynaxonConfig(basicUser: 'me');
    }

    public function testFromArray(): void
    {
        $cfg = SynaxonConfig::fromArray([
            'bearerToken' => 'abc',
            'baseUri' => 'https://example.test/api',
            'timeout' => 5,
            'maxRetries' => 0,
        ]);
        self::assertSame('https://example.test/api', $cfg->getBaseUri());
        self::assertSame(5, $cfg->getTimeout());
        self::assertSame(0, $cfg->getMaxRetries());
        self::assertSame('abc', $cfg->getBearerToken());
    }

    public function testDebugInfoMasksBearer(): void
    {
        $cfg = new SynaxonConfig(bearerToken: 'super-secret');
        $info = $cfg->__debugInfo();
        self::assertSame('bearer:***', $info['auth']);
    }

    public function testDebugInfoMasksBasicCredentialsEntirely(): void
    {
        $cfg = new SynaxonConfig(basicUser: 'alice', basicPass: 'secret');
        $info = $cfg->__debugInfo();
        self::assertSame('basic:***', $info['auth']);
        // Neither half of the credential pair may leak.
        self::assertStringNotContainsString('alice', $info['auth']);
        self::assertStringNotContainsString('secret', $info['auth']);
    }

    public function testTrailingSlashIsTrimmed(): void
    {
        $cfg = new SynaxonConfig(bearerToken: 't', baseUri: 'https://example.test/');
        self::assertSame('https://example.test', $cfg->getBaseUri());
    }

    public function testRejectsInvalidBaseUri(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new SynaxonConfig(bearerToken: 't', baseUri: 'not-a-url');
    }

    public function testRejectsNonHttpScheme(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new SynaxonConfig(bearerToken: 't', baseUri: 'ftp://example.test');
    }

    /**
     * The credential travels in the Authorization header of every request,
     * so plain http to a remote host would expose it.
     */
    public function testRejectsPlainHttpToRemoteHost(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new SynaxonConfig(bearerToken: 't', baseUri: 'http://api.example.test/marketplace');
    }

    #[DataProvider('loopbackProvider')]
    public function testAcceptsPlainHttpToLoopback(string $uri): void
    {
        $cfg = new SynaxonConfig(bearerToken: 't', baseUri: $uri);
        self::assertSame($uri, $cfg->getBaseUri());
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function loopbackProvider(): iterable
    {
        yield 'localhost' => ['http://localhost:8080'];
        yield 'ipv4' => ['http://127.0.0.1:8080/api'];
        yield 'ipv6' => ['http://[::1]:8080'];
    }

    /**
     *
     * @param array<string, string> $args
     */
    #[DataProvider('emptyCredentialProvider')]
    public function testRejectsEmptyCredentialStrings(array $args): void
    {
        $this->expectException(InvalidArgumentException::class);
        new SynaxonConfig(...$args);
    }

    /**
     * @return iterable<string, array{array<string, string>}>
     */
    public static function emptyCredentialProvider(): iterable
    {
        yield 'bearer' => [['bearerToken' => '']];
        yield 'basic user' => [['basicUser' => '', 'basicPass' => 'p']];
        yield 'basic pass' => [['basicUser' => 'u', 'basicPass' => '']];
    }

    /**
     *
     * @param array<string, string> $args
     */
    #[DataProvider('invalidConfigProvider')]
    public function testRejectsInvalidConfig(array $args, string $messagePart): void
    {
        try {
            new SynaxonConfig(...$args);
            self::fail('expected InvalidArgumentException');
        } catch (InvalidArgumentException $e) {
            self::assertStringContainsString($messagePart, $e->getMessage());
            // The message names the field, never the value.
            self::assertStringNotContainsString('s3cr3t', $e->getMessage());
        }
    }

    /**
     * @return iterable<string, array{array<string, string>, string}>
     */
    public static function invalidConfigProvider(): iterable
    {
        yield 'newline in token' => [['bearerToken' => "s3cr3t\n"], 'bearerToken must not contain control characters'];
        yield 'newline in basic pass' => [['basicUser' => 'u', 'basicPass' => "s3cr3t\r\n"], 'basicPass must not contain control characters'];
        yield 'newline in user agent' => [['bearerToken' => 't', 'userAgent' => "a\r\nX-Injected: 1"], 'userAgent must not contain control characters'];
        yield 'both credentials' => [['bearerToken' => 's3cr3t', 'basicUser' => 'u', 'basicPass' => 'p'], 'not both'];
        yield 'user info in uri' => [['bearerToken' => 't', 'baseUri' => 'https://u:s3cr3t@api.example.test'], 'user info'];
        yield 'query in uri' => [['bearerToken' => 't', 'baseUri' => 'https://api.example.test/?x=1'], 'query string'];
        yield 'fragment in uri' => [['bearerToken' => 't', 'baseUri' => 'https://api.example.test/#x'], 'fragment'];
    }

    public function testAcceptsLanguageRanges(): void
    {
        $cfg = new SynaxonConfig(bearerToken: 't', acceptLanguage: 'de-DE, en;q=0.8');
        self::assertSame('de-DE, en;q=0.8', $cfg->getAcceptLanguage());
        self::assertNull(new SynaxonConfig(bearerToken: 't')->getAcceptLanguage());
    }

    public function testRejectsMalformedAcceptLanguage(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new SynaxonConfig(bearerToken: 't', acceptLanguage: "de\r\nX-Injected: 1");
    }

    public function testCredentialsAreHiddenFromStackTraces(): void
    {
        $previous = ini_set('zend.exception_ignore_args', '0');
        try {
            new SynaxonConfig(bearerToken: 's3cr3t-token', timeout: 0);
            self::fail('expected InvalidArgumentException');
        } catch (InvalidArgumentException $e) {
            self::assertStringNotContainsString('s3cr3t-token', print_r($e->getTrace(), true));
        } finally {
            if ($previous !== false) {
                ini_set('zend.exception_ignore_args', $previous);
            }
        }
    }

    public function testFromEnvPrefersBearerOverBasic(): void
    {
        putenv('SYNAXON_BEARER_TOKEN=tok');
        putenv('SYNAXON_BASIC_USER=u');
        putenv('SYNAXON_BASIC_PASS=p');
        try {
            $cfg = SynaxonConfig::fromEnv();
            self::assertSame('tok', $cfg->getBearerToken());
            self::assertNull($cfg->getBasicUser());
        } finally {
            putenv('SYNAXON_BEARER_TOKEN');
            putenv('SYNAXON_BASIC_USER');
            putenv('SYNAXON_BASIC_PASS');
        }
    }

    public function testRejectsExcessiveTimeout(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new SynaxonConfig(bearerToken: 't', timeout: SynaxonConfig::MAX_TIMEOUT_SECONDS + 1);
    }

    public function testRejectsExcessiveMaxRetries(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new SynaxonConfig(bearerToken: 't', maxRetries: SynaxonConfig::MAX_RETRIES + 1);
    }

    public function testFromArrayIgnoresNonScalarValues(): void
    {
        $cfg = SynaxonConfig::fromArray([
            'bearerToken' => 'abc',
            'timeout' => 'not-a-number',
            'maxRetries' => ['array'],
        ]);
        // Non-numeric strings and arrays fall back to the defaults.
        self::assertSame(30, $cfg->getTimeout());
        self::assertSame(3, $cfg->getMaxRetries());
    }
}
