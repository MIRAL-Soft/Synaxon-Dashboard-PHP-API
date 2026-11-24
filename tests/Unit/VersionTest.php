<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Unit;

use miralsoft\synaxon\api\Config\SynaxonConfig;
use miralsoft\synaxon\api\Version;
use PHPUnit\Framework\TestCase;

/**
 * Version::VERSION is the one authoritative version in the code. These tests
 * keep every other place that names a version in step with it.
 */
final class VersionTest extends TestCase
{
    public function testVersionIsSemVer(): void
    {
        self::assertMatchesRegularExpression('/^\d+\.\d+\.\d+$/', Version::VERSION);
    }

    public function testNewestReleasedChangelogSectionMatchesVersion(): void
    {
        $changelog = (string) file_get_contents(dirname(__DIR__, 2) . '/CHANGELOG.md');
        $matched = preg_match('/^## \[(\d+\.\d+\.\d+)\]/m', $changelog, $m);

        self::assertSame(1, $matched, 'CHANGELOG.md has no released version section');
        self::assertSame(
            Version::VERSION,
            $m[1],
            'The newest released section in CHANGELOG.md must name Version::VERSION. '
            . 'Raise both together when a release is cut.'
        );
    }

    public function testDefaultUserAgentCarriesTheVersion(): void
    {
        self::assertStringEndsWith('/' . Version::VERSION, SynaxonConfig::DEFAULT_USER_AGENT);
    }
}
