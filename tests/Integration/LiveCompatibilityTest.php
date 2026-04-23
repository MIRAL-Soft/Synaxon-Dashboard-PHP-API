<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Integration;

use GuzzleHttp\Client as GuzzleClient;
use JsonException;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionMethod;
use Throwable;

/**
 * Live compatibility check: fetches the latest OpenAPI spec from the upstream
 * Swagger UI bundle and diffs it against the implemented Resource methods.
 *
 * Skipped unless SYNAXON_INTEGRATION=1.
 */
final class LiveCompatibilityTest extends TestCase
{
    public function testLocalImplementationMatchesLiveSpec(): void
    {
        if (getenv('SYNAXON_INTEGRATION') !== '1') {
            self::markTestSkipped('Integration disabled (set SYNAXON_INTEGRATION=1 to enable).');
        }

        $base = getenv('SYNAXON_BASE_URI');
        if ($base === false || $base === '') {
            $base = 'https://api.synaxon.com/marketplace';
        }
        $url = rtrim($base, '/') . '/swagger/swagger-ui-init.js';

        try {
            $body = (new GuzzleClient(['timeout' => 30]))->request('GET', $url)->getBody()->getContents();
        } catch (Throwable $e) {
            self::markTestSkipped('Live spec unreachable: ' . $e->getMessage());
        }

        $spec = self::extractSpec($body);
        self::assertNotEmpty($spec, 'Could not extract swaggerDoc from live JS bundle.');

        $expected    = self::collectSpecEndpoints((array) ($spec['paths'] ?? []));
        $implemented = self::collectImplementedEndpoints();

        $missing  = array_values(array_diff($expected, $implemented));
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
     * @return array<string, mixed>
     */
    private static function extractSpec(string $js): array
    {
        $marker = '"swaggerDoc":';
        $pos = strpos($js, $marker);
        if ($pos === false) {
            return [];
        }
        $start = $pos + strlen($marker);
        $depth = 0;
        $end   = $start;
        for ($i = $start, $n = strlen($js); $i < $n; $i++) {
            $ch = $js[$i];
            if ($ch === '{') {
                if ($depth === 0) {
                    $start = $i;
                }
                $depth++;
            } elseif ($ch === '}') {
                $depth--;
                if ($depth === 0) {
                    $end = $i + 1;
                    break;
                }
            }
        }
        $json = substr($js, $start, $end - $start);
        try {
            /** @var array<string, mixed> $decoded */
            $decoded = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
            return $decoded;
        } catch (JsonException) {
            return [];
        }
    }

    /**
     * @param array<string, mixed> $paths
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
