<?php

declare(strict_types=1);

/**
 * Refresh docs/openapi.json from the live SYNAXON OpenAPI document.
 *
 * The document is fetched and validated by tests/Support/LiveSpec (JSON with
 * an OpenAPI `paths` object) and written pretty-printed, so a spec change is
 * a readable diff. Run `composer generate` and `composer ci` afterwards.
 *
 * Usage: php bin/update-spec.php [url]
 * Exit codes: 0 = written, 2 = the live document could not be loaded.
 */

require_once dirname(__DIR__) . '/vendor/autoload.php';

use miralsoft\synaxon\api\Tests\Support\LiveSpec;

$url = $argv[1] ?? LiveSpec::DEFAULT_URL;
$target = dirname(__DIR__) . '/docs/openapi.json';

try {
    $spec = LiveSpec::fetch($url);
} catch (Throwable $e) {
    fwrite(STDERR, 'Could not load the live spec: ' . $e->getMessage() . "\n");
    exit(2);
}

$json = json_encode($spec, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
file_put_contents($target, $json . "\n");

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
