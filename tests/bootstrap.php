<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/vendor/autoload.php';

/*
 * Load optional test environment variables from tests/.env.test.
 *
 * The file follows a simple KEY=VALUE format (comments start with #).
 * Values are injected into $_ENV / $_SERVER / putenv() so tests can read
 * them via standard getenv() calls.
 */
$envFile = __DIR__ . '/.env.test';
if (is_file($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if ($lines !== false) {
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || str_starts_with($line, '#')) {
                continue;
            }
            if (!str_contains($line, '=')) {
                continue;
            }
            [$key, $value] = explode('=', $line, 2);
            $key   = trim($key);
            $value = trim($value);
            if ((str_starts_with($value, '"') && str_ends_with($value, '"'))
                || (str_starts_with($value, "'") && str_ends_with($value, "'"))) {
                $value = substr($value, 1, -1);
            }
            if (getenv($key) === false || getenv($key) === '') {
                putenv("{$key}={$value}");
                $_ENV[$key]    = $value;
                $_SERVER[$key] = $value;
            }
        }
    }
}
