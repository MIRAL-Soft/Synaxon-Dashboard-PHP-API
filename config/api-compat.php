<?php

declare(strict_types=1);

/**
 * Configuration for bin/check-api-compat.php.
 *
 * Adjust paths and the live spec URL here if the upstream layout changes.
 */

return [
    /*
     * Local pretty-printed copy of the spec (committed alongside the code).
     */
    'local_spec' => dirname(__DIR__) . '/docs/openapi.json',

    /*
     * Live URL of the OpenAPI document the Swagger UI loads. Until November
     * 2026 it was embedded in swagger-ui-init.js; that file now answers HTML.
     */
    'live_url'   => \miralsoft\synaxon\api\Tests\Support\LiveSpec::DEFAULT_URL,

    /*
     * Where to scan for implemented endpoint methods. Public methods carrying
     * a @synaxon-endpoint <METHOD> <PATH> phpdoc tag are counted.
     */
    'resource_dir' => dirname(__DIR__) . '/src/Resource',

    /*
     * Default snapshot output location for `--snapshot`.
     */
    'snapshot_path' => dirname(__DIR__) . '/build/api-compat-report.json',
];
