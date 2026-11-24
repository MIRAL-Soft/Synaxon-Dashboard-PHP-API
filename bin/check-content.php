<?php

declare(strict_types=1);

/**
 * Content check for every tracked text file, the CI half of the local git
 * hooks: the same patterns and the same exclusions, so the two never disagree
 * about what is covered.
 *
 *   - No em-dash characters in prose we write (house style). Material quoted
 *     from upstream, the SYNAXON OpenAPI document, is excluded and stays as
 *     delivered.
 *   - No secrets: a private key block in any file, without exception; an
 *     API-key-like or password assignment in any file except the upstream
 *     material listed in SECRET_EXCLUDE, whose fields called "password" are
 *     names, not values. Every file left out is named on every run.
 *
 * Before any real file is read, every detector is tried on a planted input it
 * must match and on a clean input it must not, including the exclusion. A
 * detector that cannot fire, or fires on anything, fails the run: a pass from
 * it would mean nothing.
 *
 * Usage: php bin/check-content.php
 * Exit codes: 0 = clean, 1 = findings or a broken detector, 2 = git unavailable.
 */

$root = dirname(__DIR__);

/** Files checked for em-dashes. `*` also spans `/`, so `*.md` reaches every depth. */
const CONTENT_GLOBS = ['*.md', '*.php', '*.json', '*.yml', '*.neon', '*.xml', '*.dist', '*.example', '.gitattributes', '.gitignore'];

/** Left out of the em-dash check: upstream material and generated lock data. */
const CONTENT_EXCLUDE = ['docs/openapi.json', 'composer.lock'];

/**
 * Left out of the API-key and password patterns, never out of the private-key
 * check: material the project did not write (exact paths, each one recorded
 * with its reason). Keep in step with SECRET_EXCLUDE in the local hook config.
 */
const SECRET_EXCLUDE = ['docs/openapi.json'];

const EMDASH = "\u{2014}";

/** Never excluded. */
const PRIVATE_KEY_PATTERN = '/BEGIN [A-Z ]*PRIVATE KEY/';

/** The hook's patterns, character for character; excluded for SECRET_EXCLUDE. */
const ASSIGNMENT_PATTERNS = [
    'API-key-like assignment' => '/(api[_-]?key|secret|token)["\' ]*[:=]["\' ]*[A-Za-z0-9_\-]{16,}/i',
    'password assignment' => '/password["\' ]*[:=]["\' ]*[^\s"\']+/i',
];

/**
 * @return list<string> names of the detectors that matched
 */
function findingsIn(string $text, bool $checkEmDash, bool $secretExcluded): array
{
    $found = [];
    if ($checkEmDash && str_contains($text, EMDASH)) {
        $found[] = 'em-dash';
    }
    if (preg_match(PRIVATE_KEY_PATTERN, $text) === 1) {
        $found[] = 'private key block';
    }
    if (!$secretExcluded) {
        foreach (ASSIGNMENT_PATTERNS as $name => $pattern) {
            if (preg_match($pattern, $text) === 1) {
                $found[] = $name;
            }
        }
    }

    return $found;
}

// R-20: every detector proves it can fire and that it stays quiet, the
// exclusion included. The probes are assembled from pieces so this file does
// not trip its own scan.
$privateKey = implode(' ', ['-----BEGIN', 'RSA', 'PRIVATE', 'KEY-----']);
$apiKey = sprintf('%s_%s = "%s"', 'api', 'key', 'abcdefghij1234567890');
$passwordField = sprintf('"%s": %s', 'password', '{');
$probes = [
    // [input, check em-dash, secret-excluded file, expected]
    ['planted ' . EMDASH . ' here', true, false, ['em-dash']],
    ['planted ' . EMDASH . ' here', false, false, []],
    [$privateKey, true, false, ['private key block']],
    [$privateKey, true, true, ['private key block']],
    [$apiKey, true, false, ['API-key-like assignment']],
    [$apiKey, true, true, []],
    [$passwordField, true, false, ['password assignment']],
    [$passwordField, true, true, []],
    ['a clean line, with commas (and parentheses)', true, false, []],
    ['the api key and the password are mentioned in prose', true, false, []],
    ['$token = $this->config->getBearerToken();', true, false, []],
];
foreach ($probes as [$input, $emDash, $excluded, $expected]) {
    $actual = findingsIn($input, $emDash, $excluded);
    if ($actual !== $expected) {
        fwrite(STDERR, sprintf(
            "Detector self-test failed on %s (excluded: %s): expected [%s], got [%s].\n",
            json_encode($input),
            $excluded ? 'yes' : 'no',
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
$secretSkipped = [];
foreach ($files as $rel) {
    $path = $root . '/' . $rel;
    if (!is_file($path)) {
        continue;
    }
    $content = (string) file_get_contents($path);
    if (str_contains($content, "\0")) {
        continue; // binary
    }

    $emDash = !in_array($rel, CONTENT_EXCLUDE, true);
    if ($emDash) {
        $emDash = false;
        foreach (CONTENT_GLOBS as $glob) {
            if (fnmatch($glob, $rel) || fnmatch($glob, basename($rel))) {
                $emDash = true;
                break;
            }
        }
    }
    $excluded = in_array($rel, SECRET_EXCLUDE, true);
    if ($excluded) {
        $secretSkipped[] = $rel;
    }

    $checked++;
    foreach (explode("\n", $content) as $i => $line) {
        foreach (findingsIn($line, $emDash, $excluded) as $what) {
            // Only the location reaches the log, never the matched value.
            $problems[] = sprintf('%s:%d: %s', $rel, $i + 1, $what);
        }
    }
}

foreach (SECRET_EXCLUDE as $rel) {
    if (!in_array($rel, $secretSkipped, true)) {
        fwrite(STDERR, "SECRET_EXCLUDE names {$rel}, which is not a tracked file; remove the entry.\n");
        exit(1);
    }
}
foreach ($secretSkipped as $rel) {
    fwrite(STDERR, "{$rel} matches SECRET_EXCLUDE; the API-key and password patterns were not applied to it.\n");
}

if ($checked === 0) {
    fwrite(STDERR, "No file was read; the check did not run.\n");
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
