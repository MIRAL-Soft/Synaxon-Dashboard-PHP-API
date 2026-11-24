<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Integration;

use miralsoft\synaxon\api\Tests\Support\LiveSpec;
use miralsoft\synaxon\api\Tests\testConfig;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionMethod;
use Throwable;

/**
 * Live compatibility check: fetches the latest OpenAPI spec from upstream
 * (see LiveSpec) and diffs it against the implemented Resource methods.
 *
 * Skipped automatically when no credentials are configured; this test does
 * not authenticate (the spec is public) but it is still gated on
 * credentials so the live integration suite has a single on/off switch
 * governed entirely by tests/.env.test.
 */
final class LiveCompatibilityTest extends TestCase
{
    public function testLocalImplementationMatchesLiveSpec(): void
    {
        if (!testConfig::hasCredentials()) {
            self::markTestSkipped('Integration credentials missing in tests/.env.test.');
        }

        try {
            $spec = LiveSpec::fetch();
        } catch (Throwable $e) {
            self::markTestSkipped('Live spec unavailable: ' . $e->getMessage());
        }

        $expected = self::collectSpecEndpoints((array) ($spec['paths'] ?? []));
        $implemented = self::collectImplementedEndpoints();

        $missing = array_values(array_diff($expected, $implemented));
        $orphaned = array_values(array_diff($implemented, $expected));

        if ($missing !== [] || $orphaned !== []) {
            self::fail(sprintf(
                "Live API drift detected.\nMissing in code (%d):\n  - %s\nOrphaned methods (%d):\n  - %s",
                count($missing),
                $missing === [] ? '(none)' : implode("\n  - ", $missing),
                count($orphaned),
                $orphaned === [] ? '(none)' : implode("\n  - ", $orphaned)
            ));
        }
        $this->addToAssertionCount(1);
    }

    /**
     * @param array<string, mixed> $paths
     *
     * @return list<string>
     */
    private static function collectSpecEndpoints(array $paths): array
    {
        $out = [];
        foreach ($paths as $path => $obj) {
            if (!is_string($path) || !is_array($obj)) {
                continue;
            }
            foreach (['get','post','put','patch','delete','head','options'] as $m) {
                if (isset($obj[$m]) && is_array($obj[$m])) {
                    $out[] = strtoupper($m) . ' ' . $path;
                }
            }
        }
        sort($out);
        return $out;
    }

    /**
     * @return list<string>
     */
    private static function collectImplementedEndpoints(): array
    {
        $dir = dirname(__DIR__, 2) . '/src/Resource';
        $files = glob($dir . '/*.php') ?: [];
        $out = [];
        foreach ($files as $file) {
            $base = basename($file, '.php');
            if ($base === 'AbstractResource') {
                continue;
            }
            $class = 'miralsoft\\synaxon\\api\\Resource\\' . $base;
            $ref = new ReflectionClass($class);
            foreach ($ref->getMethods(ReflectionMethod::IS_PUBLIC) as $m) {
                if ($m->class !== $class) {
                    continue;
                }
                $doc = $m->getDocComment();
                if ($doc === false) {
                    continue;
                }
                if (preg_match('/@synaxon-endpoint\s+(\S+)\s+(\S+)/', $doc, $match) === 1) {
                    $out[] = strtoupper($match[1]) . ' ' . $match[2];
                }
            }
        }
        sort($out);
        return $out;
    }
}
