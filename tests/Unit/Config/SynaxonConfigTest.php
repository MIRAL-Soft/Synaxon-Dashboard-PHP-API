<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Unit\Config;

use InvalidArgumentException;
use miralsoft\synaxon\api\Config\SynaxonConfig;
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
            'baseUri'     => 'https://example.test/api',
            'timeout'     => 5,
            'maxRetries'  => 0,
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

    public function testDebugInfoMasksBasicPassword(): void
    {
        $cfg = new SynaxonConfig(basicUser: 'alice', basicPass: 'secret');
        $info = $cfg->__debugInfo();
        self::assertSame('basic:alice:***', $info['auth']);
    }

    public function testTrailingSlashIsTrimmed(): void
    {
        $cfg = new SynaxonConfig(bearerToken: 't', baseUri: 'https://example.test/');
        self::assertSame('https://example.test', $cfg->getBaseUri());
    }
}
