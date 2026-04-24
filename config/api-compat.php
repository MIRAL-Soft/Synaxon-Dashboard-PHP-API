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
     * Live URL of the Swagger UI initialiser bundle. The compatibility tool
     * extracts the swaggerDoc object from this JS file at runtime.
     */
    'live_url'   => 'https://api.synaxon.com/marketplace/swagger/swagger-ui-init.js',

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
