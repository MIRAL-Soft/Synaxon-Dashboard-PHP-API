<?php

declare(strict_types=1);

/**
 * Refresh docs/openapi.json from the live SYNAXON OpenAPI document.
 *
 * The document is fetched and validated by Compat\ApiCompatibility (JSON with
 * an OpenAPI `paths` object) and written pretty-printed, so a spec change is
 * a readable diff. Run `composer generate` and `composer ci` afterwards.
 *
 * Usage: php bin/update-spec.php [url]
 * Exit codes: 0 = written, 2 = the live document could not be loaded.
 */

require_once dirname(__DIR__) . '/vendor/autoload.php';

use miralsoft\synaxon\api\Compat\ApiCompatibility;

$url = $argv[1] ?? ApiCompatibility::DEFAULT_SPEC_URL;
$target = dirname(__DIR__) . '/docs/openapi.json';

try {
    $raw = new ApiCompatibility($url)->fetchSpecJson();
} catch (Throwable $e) {
    fwrite(STDERR, 'Could not load the live spec: ' . $e->getMessage() . "\n");
    exit(2);
}

// Decoded as objects, not arrays, so empty objects stay `{}` and the file
// remains valid OpenAPI; only the indentation changes.
$json = json_encode(
    json_decode($raw, false, 512, JSON_THROW_ON_ERROR),
    JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR
);
file_put_contents($target, $json . "\n");
$spec = json_decode($raw, true, 512, JSON_THROW_ON_ERROR);

$operations = 0;
foreach ((array) $spec['paths'] as $item) {
    foreach (['get', 'post', 'put', 'patch', 'delete', 'head', 'options'] as $method) {
        if (is_array($item) && isset($item[$method])) {
            $operations++;
        }
    }
}

printf(
    "Wrote %s: %d operations, %d schemas.\nNext: composer generate && composer ci\n",
    'docs/openapi.json',
    $operations,
    count((array) ($spec['components']['schemas'] ?? [])),
);
