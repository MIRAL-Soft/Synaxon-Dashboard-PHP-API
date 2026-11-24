<?php

declare(strict_types=1);

/**
 * Generated-code reproducibility check.
 *
 * Reruns every generator (the same invocation as `composer generate`) and
 * fails when the result differs from the files in the working tree, so the
 * committed output can only ever be what the committed generators and the
 * committed spec produce. Line endings are normalised to LF before the
 * comparison; nothing else is excluded.
 *
 * It fails on three kinds of drift:
 *   - a generated file whose content changes when regenerated
 *     (output edited by hand, or a source changed without regenerating),
 *   - a file the generators write that does not exist yet,
 *   - a file in a generated location that no generator writes any more
 *     (a stale leftover, for example the DTO of a schema that was removed).
 *
 * Before it trusts its own verdict it plants a change in one generated file
 * and requires the comparison to report exactly that file. A detector that
 * cannot fire fails the run instead of passing it.
 *
 * Usage: php bin/check-generated.php
 * Exit codes: 0 = reproducible, 1 = drift or a broken detector, 2 = a generator failed.
 */

$root = dirname(__DIR__);

/** Generators in dependency order: later ones read what earlier ones wrote. */
$generators = [
    'bin/generate-dtos.php',
    'bin/generate-resources.php',
    'bin/generate-write-tests.php',
    'bin/generate-integration-read-tests.php',
];

/** Locations the generators write to. */
$generatedGlobs = [
    'src/DTO/*.php',
    'src/Resource/*.php',
    'src/Client/*.php',
    'config/generated-endpoints.json',
    'tests/Unit/Resource/*.php',
    'tests/Integration/ReadOnly/*.php',
];

/** Hand-written files that live inside those locations. */
$handWritten = [
    'src/DTO/AbstractDto.php',
    'src/Resource/AbstractResource.php',
    'tests/Integration/ReadOnly/EndpointSamplingTrait.php',
];

/**
 * @param list<string> $globs
 * @param list<string> $exclude
 *
 * @return array<string, string> relative path => content with LF line endings
 */
function snapshot(string $root, array $globs, array $exclude): array
{
    $out = [];
    foreach ($globs as $glob) {
        foreach (glob($root . '/' . $glob) ?: [] as $file) {
            $rel = substr($file, strlen($root) + 1);
            if (in_array($rel, $exclude, true)) {
                continue;
            }
            $out[$rel] = str_replace("\r\n", "\n", (string) file_get_contents($file));
        }
    }
    ksort($out);

    return $out;
}

/**
 * @param array<string, string> $before
 * @param array<string, string> $after
 *
 * @return list<string>
 */
function changedFiles(array $before, array $after): array
{
    $changed = [];
    foreach ($after as $rel => $content) {
        if (!array_key_exists($rel, $before) || $before[$rel] !== $content) {
            $changed[] = $rel;
        }
    }

    return $changed;
}

$before = snapshot($root, $generatedGlobs, $handWritten);
if ($before === []) {
    fwrite(STDERR, "No generated files found. Is this the repository root?\n");
    exit(1);
}

// Self-test: plant a change in one generated file on disk, as a hand edit
// would. The run below must report it, which proves both that the
// generators rewrite that file and that the comparison sees a difference.
// Regenerating restores the file; if a generator fails, it is restored here.
$planted = array_key_first($before);
$plantedPath = $root . '/' . $planted;
$plantedOriginal = (string) file_get_contents($plantedPath);
file_put_contents($plantedPath, $plantedOriginal . "\n// planted by bin/check-generated.php\n");
$before[$planted] = str_replace("\r\n", "\n", (string) file_get_contents($plantedPath));
register_shutdown_function(static function () use ($plantedPath, $plantedOriginal): void {
    if (str_contains((string) file_get_contents($plantedPath), '// planted by bin/check-generated.php')) {
        file_put_contents($plantedPath, $plantedOriginal);
    }
});

// Mark every generated file as not yet written, so a file no generator
// touches can be told apart from one that was rewritten unchanged.
$sentinel = 1_000_000_000;
foreach (array_keys($before) as $rel) {
    touch($root . '/' . $rel, $sentinel);
}
clearstatcache();

foreach ($generators as $generator) {
    $cmd = escapeshellarg(PHP_BINARY) . ' ' . escapeshellarg($root . '/' . $generator);
    $output = [];
    exec($cmd . ' 2>&1', $output, $status);
    if ($status !== 0) {
        fwrite(STDERR, "Generator failed: {$generator} (exit {$status})\n" . implode("\n", $output) . "\n");
        exit(2);
    }
}
clearstatcache();

$after = snapshot($root, $generatedGlobs, $handWritten);
$changed = changedFiles($before, $after);

if (!in_array($planted, $changed, true) || str_contains($after[$planted] ?? '', 'planted by bin/check-generated.php')) {
    fwrite(STDERR, "The detector is dead: a planted change in {$planted} was not reported or not overwritten.\n");
    fwrite(STDERR, "Nothing this check says can be trusted, including a pass.\n");
    exit(1);
}
$changed = array_values(array_diff($changed, [$planted]));

$stale = [];
foreach (array_keys($after) as $rel) {
    if (filemtime($root . '/' . $rel) === $sentinel) {
        $stale[] = $rel;
    }
}

if ($changed === [] && $stale === []) {
    printf(
        "Generated code is reproducible: %d files match their generators (detector verified on %s).\n",
        count($after),
        $planted,
    );
    exit(0);
}

if ($changed !== []) {
    fwrite(STDERR, "Regenerating changed these files. Commit the regenerated output with its source,\n");
    fwrite(STDERR, "or move a hand edit into the generator (never edit generated files):\n");
    foreach ($changed as $rel) {
        fwrite(STDERR, "  {$rel}\n");
    }
}
if ($stale !== []) {
    fwrite(STDERR, "No generator writes these files any more. Delete them, or list a\n");
    fwrite(STDERR, "hand-written file in \$handWritten in this script:\n");
    foreach ($stale as $rel) {
        fwrite(STDERR, "  {$rel}\n");
    }
}
exit(1);
