<?php

declare(strict_types=1);

/**
 * Content check for every tracked text file.
 *
 *   - No em-dash characters in prose we write (house style). Material quoted
 *     from upstream, the SYNAXON OpenAPI document, is excluded and stays as
 *     delivered.
 *   - No secret-like strings: private key blocks and `api_key = "..."`-style
 *     assignments of a long literal value.
 *
 * Before any real file is read, every detector is tried on a planted input it
 * must match and on a clean input it must not. A detector that cannot fire, or
 * fires on anything, fails the run: a pass from it would mean nothing.
 *
 * Usage: php bin/check-content.php
 * Exit codes: 0 = clean, 1 = findings or a broken detector, 2 = git unavailable.
 */

$root = dirname(__DIR__);

/** Files checked. `*` also spans `/`, so `*.md` reaches every depth. */
const CONTENT_GLOBS = ['*.md', '*.php', '*.json', '*.yml', '*.neon', '*.xml', '*.dist', '*.example', '.gitattributes', '.gitignore'];

/** Skipped even where a glob matches: upstream material and generated lock data. */
const CONTENT_EXCLUDE = ['docs/openapi.json', 'docs/swagger-ui-init.js', 'composer.lock'];

const EMDASH = "\u{2014}";

/** Secret patterns, case-insensitive. */
const SECRET_PATTERNS = [
    'private key block' => '/-----BEGIN [A-Z ]*PRIVATE KEY-----/',
    'credential assignment' => '/(api[_-]?key|secret|token|passw(or)?d|_pass)["\' ]*[:=]["\' ]*[A-Za-z0-9_\-]{16,}/i',
];

/**
 * @return list<string> names of the detectors that matched
 */
function findingsIn(string $text): array
{
    $found = [];
    if (str_contains($text, EMDASH)) {
        $found[] = 'em-dash';
    }
    foreach (SECRET_PATTERNS as $name => $pattern) {
        if (preg_match($pattern, $text) === 1) {
            $found[] = $name;
        }
    }

    return $found;
}

// R-20: every detector proves it can fire and that it stays quiet. The probes
// are assembled from pieces so this file does not trip its own scan.
$probes = [
    ['planted ' . EMDASH . ' here', ['em-dash']],
    [implode(' ', ['-----BEGIN', 'RSA', 'PRIVATE', 'KEY-----']), ['private key block']],
    [sprintf('%s_%s = "%s"', 'api', 'key', 'abcdefghij1234567890'), ['credential assignment']],
    [sprintf('SYNAXON_BASIC_%s=%s', 'PASS', 'abcdefghij1234567890abcdef'), ['credential assignment']],
    [sprintf('%s: "%s"', 'password', 'abcdefghij1234567890'), ['credential assignment']],
    ['basicPass: $secrets->get("synaxon.client_secret"),', []],
    ['a clean line, with commas (and parentheses)', []],
    ['the api key is mentioned in ordinary prose', []],
    ['$token = $this->config->getBearerToken();', []],
];
foreach ($probes as [$input, $expected]) {
    $actual = findingsIn($input);
    if ($actual !== $expected) {
        fwrite(STDERR, sprintf(
            "Detector self-test failed on %s: expected [%s], got [%s].\n",
            json_encode($input),
            implode(', ', $expected),
            implode(', ', $actual),
        ));
        fwrite(STDERR, "Nothing this check says can be trusted, including a pass.\n");
        exit(1);
    }
}

$files = [];
exec('git -C ' . escapeshellarg($root) . ' ls-files --cached --others --exclude-standard', $files, $status);
if ($status !== 0 || $files === []) {
    fwrite(STDERR, "Could not list files through git; the check did not run.\n");
    exit(2);
}

$checked = 0;
$problems = [];
foreach ($files as $rel) {
    if (in_array($rel, CONTENT_EXCLUDE, true)) {
        continue;
    }
    $matches = false;
    foreach (CONTENT_GLOBS as $glob) {
        if (fnmatch($glob, $rel) || fnmatch($glob, basename($rel))) {
            $matches = true;
            break;
        }
    }
    if (!$matches || !is_file($root . '/' . $rel)) {
        continue;
    }
    $checked++;
    $lines = file($root . '/' . $rel) ?: [];
    foreach ($lines as $i => $line) {
        foreach (findingsIn($line) as $what) {
            $problems[] = sprintf('%s:%d: %s', $rel, $i + 1, $what);
        }
    }
}

if ($checked === 0) {
    fwrite(STDERR, "No file matched CONTENT_GLOBS; the check did not run.\n");
    exit(1);
}

if ($problems !== []) {
    fwrite(STDERR, "Content check failed:\n  " . implode("\n  ", $problems) . "\n");
    fwrite(STDERR, "Rewrite em-dashes with commas, colons, parentheses or separate sentences.\n");
    fwrite(STDERR, "Move secrets out of the repository; they belong in environment configuration.\n");
    exit(1);
}

printf("Content check passed: %d files, detectors verified on %d probes.\n", $checked, count($probes));
exit(0);
