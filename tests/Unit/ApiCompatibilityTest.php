<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Unit;

use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionMethod;

/**
 * Offline compatibility check: walks the local OpenAPI spec and verifies
 * that every operation has at least one corresponding @synaxon-endpoint
 * tag in our generated Resource methods.
 *
 * Drift between spec and code surfaces here as a failing test so we always
 * notice when an upstream change is missed.
 */
final class ApiCompatibilityTest extends TestCase
{
    public function testEverySpecOperationHasAnImplementation(): void
    {
        $specPath = dirname(__DIR__, 2) . '/docs/openapi.json';
        self::assertFileExists($specPath, 'docs/openapi.json must exist');

        /** @var array<string, mixed> $spec */
        $spec = json_decode((string) file_get_contents($specPath), true, 512, JSON_THROW_ON_ERROR);
        $expected = self::collectSpecEndpoints((array) ($spec['paths'] ?? []));
        $implemented = self::collectImplementedEndpoints();

        $missing = array_values(array_diff($expected, $implemented));

        self::assertEmpty(
            $missing,
            sprintf("Missing implementations for %d endpoint(s):\n  - %s", count($missing), implode("\n  - ", $missing))
        );
    }

    public function testEveryImplementationMatchesAKnownSpecEndpoint(): void
    {
        $specPath = dirname(__DIR__, 2) . '/docs/openapi.json';
        /** @var array<string, mixed> $spec */
        $spec = json_decode((string) file_get_contents($specPath), true, 512, JSON_THROW_ON_ERROR);
        $expected = self::collectSpecEndpoints((array) ($spec['paths'] ?? []));
        $implemented = self::collectImplementedEndpoints();

        $orphaned = array_values(array_diff($implemented, $expected));

        self::assertEmpty(
            $orphaned,
            sprintf("Orphaned methods (no longer in spec): %d\n  - %s", count($orphaned), implode("\n  - ", $orphaned))
        );
    }

    /**
     * @param array<string, mixed> $paths
     *
     * @return list<string> e.g. "GET /v1/audit/logs"
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
