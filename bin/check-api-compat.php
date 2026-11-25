<?php

declare(strict_types=1);

/**
 * SYNAXON API compatibility checker, the maintainer's command-line view of
 * Compat\ApiCompatibility, which applications can call themselves.
 *
 * Compares the surface this library implements (Compat\ApiSurface) with
 * either the committed spec (docs/openapi.json) or the live spec.
 *
 * Usage:
 *   php bin/check-api-compat.php                # offline, against docs/openapi.json
 *   php bin/check-api-compat.php --live         # against the live spec
 *   php bin/check-api-compat.php --snapshot     # also write the report to build/
 *
 * Exit codes: 0 = compatible, 1 = drift detected, 2 = spec unavailable.
 */

require_once dirname(__DIR__) . '/vendor/autoload.php';

use miralsoft\synaxon\api\Compat\ApiCompatibility;
use miralsoft\synaxon\api\Compat\CompatibilityReport;

$config = require dirname(__DIR__) . '/config/api-compat.php';

$opts = getopt('', ['live', 'snapshot', 'help']);
if (isset($opts['help'])) {
    fwrite(STDOUT, "Usage: php bin/check-api-compat.php [--live] [--snapshot]\n");
    exit(0);
}

$live = array_key_exists('live', $opts);

try {
    if ($live) {
        $checker = new ApiCompatibility((string) $config['live_url']);
        $source = $checker->getSpecUrl();
        $report = $checker->compare();
    } else {
        $source = (string) $config['local_spec'];
        if (!is_file($source)) {
            throw new RuntimeException("Local spec not found: {$source}");
        }
        /** @var array<string, mixed> $spec */
        $spec = json_decode((string) file_get_contents($source), true, 512, JSON_THROW_ON_ERROR);
        $report = ApiCompatibility::compareSpec($spec);
    }
} catch (Throwable $e) {
    fwrite(STDERR, 'Failed to load spec: ' . $e->getMessage() . "\n");
    exit(2);
}

render($report, $live ? 'live' : 'local', $source);

if (array_key_exists('snapshot', $opts)) {
    $path = (string) $config['snapshot_path'];
    if (!is_dir(dirname($path))) {
        mkdir(dirname($path), 0o755, true);
    }
    file_put_contents($path, json_encode(
        ['generated_at' => date(DATE_ATOM), 'mode' => $live ? 'live' : 'local', 'source' => $source] + $report->toArray(),
        JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
    ));
    fwrite(STDOUT, "Snapshot written to: {$path}\n");
}

exit($report->isCompatible() ? 0 : 1);

function render(CompatibilityReport $report, string $mode, string $source): void
{
    fwrite(STDOUT, "\n=== SYNAXON API compatibility report ({$mode}) ===\n");
    fwrite(STDOUT, "Spec: {$source}" . ($report->specVersion !== null ? " (version {$report->specVersion})" : '') . "\n");
    fwrite(STDOUT, sprintf("Endpoints: %d implemented / %d expected\n", $report->implementedOperationCount, $report->specOperationCount));
    fwrite(STDOUT, sprintf("Schemas:   %d implemented / %d expected\n", $report->implementedSchemaCount, $report->specSchemaCount));

    section('Missing endpoint implementations', $report->missingOperations);
    section('Endpoints removed upstream (calls will fail)', $report->removedOperations);
    section('Missing schema DTOs', $report->missingSchemas);
    section('Schemas removed upstream', $report->removedSchemas);

    fwrite(STDOUT, $report->isCompatible() ? "\nResult: OK\n" : "\nResult: DRIFT DETECTED\n");
}

/**
 * @param list<string> $items
 */
function section(string $heading, array $items): void
{
    fwrite(STDOUT, "\n--- {$heading} (" . count($items) . ") ---\n");
    fwrite(STDOUT, $items === [] ? "(none)\n" : '  - ' . implode("\n  - ", $items) . "\n");
}
