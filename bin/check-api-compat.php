<?php

declare(strict_types=1);

/**
 * SYNAXON API compatibility checker.
 *
 * Diffs the implemented surface (everything tagged @synaxon-endpoint in
 * src/Resource/*) against either the local spec (docs/openapi.json) or the
 * live spec (extracted from the upstream Swagger UI bundle).
 *
 * Usage:
 *   php bin/check-api-compat.php                # offline check against local spec
 *   php bin/check-api-compat.php --live         # online check against live spec
 *   php bin/check-api-compat.php --snapshot     # write JSON report to build/
 *   php bin/check-api-compat.php --live --snapshot
 *
 * Exit codes: 0 = compatible, 1 = drift detected, 2 = spec unreachable.
 */

require_once dirname(__DIR__) . '/vendor/autoload.php';

$config = require dirname(__DIR__) . '/config/api-compat.php';

$opts = getopt('', ['live', 'snapshot', 'help']);
if (isset($opts['help'])) {
    fwrite(STDOUT, "Usage: php bin/check-api-compat.php [--live] [--snapshot]\n");
    exit(0);
}

$useLive = array_key_exists('live', $opts);
$snapshot = array_key_exists('snapshot', $opts);

try {
    $spec = $useLive ? loadLiveSpec($config['live_url']) : loadLocalSpec($config['local_spec']);
} catch (Throwable $e) {
    fwrite(STDERR, 'Failed to load spec: ' . $e->getMessage() . "\n");
    exit(2);
}

$expectedEndpoints = collectSpecEndpoints((array) ($spec['paths'] ?? []));
$implementedEndpoints = collectImplementedEndpoints((string) $config['resource_dir']);

$expectedSchemas = array_keys((array) ($spec['components']['schemas'] ?? []));
$implementedSchemas = collectImplementedSchemas(dirname(__DIR__) . '/src/DTO');

$missingEndpoints = array_values(array_diff($expectedEndpoints, $implementedEndpoints));
$orphanedEndpoints = array_values(array_diff($implementedEndpoints, $expectedEndpoints));
$missingSchemas = array_values(array_diff($expectedSchemas, $implementedSchemas));
$orphanedSchemas = array_values(array_diff($implementedSchemas, $expectedSchemas));

renderReport($spec, [
    'mode' => $useLive ? 'live' : 'local',
    'expected' => count($expectedEndpoints),
    'implemented' => count($implementedEndpoints),
    'missing_endpoints' => $missingEndpoints,
    'orphaned_endpoints' => $orphanedEndpoints,
    'expected_schemas' => count($expectedSchemas),
    'implemented_schemas' => count($implementedSchemas),
    'missing_schemas' => $missingSchemas,
    'orphaned_schemas' => $orphanedSchemas,
]);

if ($snapshot) {
    $path = (string) $config['snapshot_path'];
    $dir = dirname($path);
    if (!is_dir($dir)) {
        mkdir($dir, 0o755, true);
    }
    file_put_contents($path, json_encode([
        'generated_at' => date(DATE_ATOM),
        'mode' => $useLive ? 'live' : 'local',
        'spec_title' => $spec['info']['title'] ?? null,
        'spec_version' => $spec['info']['version'] ?? null,
        'expected_endpoints' => $expectedEndpoints,
        'implemented_endpoints' => $implementedEndpoints,
        'missing_endpoints' => $missingEndpoints,
        'orphaned_endpoints' => $orphanedEndpoints,
        'expected_schemas' => $expectedSchemas,
        'implemented_schemas' => $implementedSchemas,
        'missing_schemas' => $missingSchemas,
        'orphaned_schemas' => $orphanedSchemas,
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    fwrite(STDOUT, "Snapshot written to: {$path}\n");
}

if ($missingEndpoints !== [] || $orphanedEndpoints !== [] || $missingSchemas !== [] || $orphanedSchemas !== []) {
    exit(1);
}
exit(0);

/* ---------------------------------------------------------------- helpers */

/**
 * @return array<string, mixed>
 */
function loadLocalSpec(string $path): array
{
    if (!is_file($path)) {
        throw new RuntimeException("Local spec not found: {$path}");
    }
    /** @var array<string, mixed> $decoded */
    $decoded = json_decode((string) file_get_contents($path), true, 512, JSON_THROW_ON_ERROR);
    return $decoded;
}

/**
 * @return array<string, mixed>
 */
function loadLiveSpec(string $url): array
{
    $client = new GuzzleHttp\Client(['timeout' => 30]);
    $body = $client->request('GET', $url)->getBody()->getContents();

    $marker = '"swaggerDoc":';
    $pos = strpos($body, $marker);
    if ($pos === false) {
        throw new RuntimeException('swaggerDoc not found in live JS bundle.');
    }
    $start = $pos + strlen($marker);
    $depth = 0;
    $end = $start;
    for ($i = $start, $n = strlen($body); $i < $n; $i++) {
        $ch = $body[$i];
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
    /** @var array<string, mixed> $decoded */
    $decoded = json_decode(substr($body, $start, $end - $start), true, 512, JSON_THROW_ON_ERROR);
    return $decoded;
}

/**
 * @param array<string, mixed> $paths
 *
 * @return list<string>
 */
function collectSpecEndpoints(array $paths): array
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
function collectImplementedEndpoints(string $dir): array
{
    $files = glob($dir . '/*.php') ?: [];
    $out = [];
    foreach ($files as $file) {
        $base = basename($file, '.php');
        if ($base === 'AbstractResource') {
            continue;
        }
        $class = 'miralsoft\\synaxon\\api\\Resource\\' . $base;
        if (!class_exists($class)) {
            continue;
        }
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

/**
 * @return list<string>
 */
function collectImplementedSchemas(string $dir): array
{
    $files = glob($dir . '/*.php') ?: [];
    $out = [];
    foreach ($files as $file) {
        $base = basename($file, '.php');
        if ($base === 'AbstractDto') {
            continue;
        }
        $out[] = $base;
    }
    sort($out);
    return $out;
}

/**
 * @param array<string, mixed> $spec
 * @param array<string, mixed> $report
 */
function renderReport(array $spec, array $report): void
{
    $title = (string) ($spec['info']['title'] ?? 'unknown');
    $version = (string) ($spec['info']['version'] ?? 'unknown');

    fwrite(STDOUT, "\n=== SYNAXON API compatibility report ({$report['mode']}) ===\n");
    fwrite(STDOUT, sprintf("Spec: %s v%s\n", $title, $version));
    fwrite(STDOUT, sprintf("Endpoints: %d implemented / %d expected\n", $report['implemented'], $report['expected']));
    fwrite(STDOUT, sprintf("Schemas:   %d implemented / %d expected\n", $report['implemented_schemas'], $report['expected_schemas']));

    renderSection('Missing endpoint implementations', $report['missing_endpoints']);
    renderSection('Orphaned endpoint methods (no longer in spec)', $report['orphaned_endpoints']);
    renderSection('Missing schema DTOs', $report['missing_schemas']);
    renderSection('Orphaned schema DTOs', $report['orphaned_schemas']);

    $ok = $report['missing_endpoints'] === []
       && $report['orphaned_endpoints'] === []
       && $report['missing_schemas'] === []
       && $report['orphaned_schemas'] === [];
    fwrite(STDOUT, $ok ? "\nResult: OK\n" : "\nResult: DRIFT DETECTED\n");
}

/**
 * @param list<string> $items
 */
function renderSection(string $heading, array $items): void
{
    fwrite(STDOUT, "\n--- {$heading} (" . count($items) . ") ---\n");
    if ($items === []) {
        fwrite(STDOUT, "(none)\n");
        return;
    }
    foreach ($items as $item) {
        fwrite(STDOUT, "  - {$item}\n");
    }
}
