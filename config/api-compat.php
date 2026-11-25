<?php

declare(strict_types=1);

use miralsoft\synaxon\api\Compat\ApiCompatibility;

/**
 * Configuration for bin/check-api-compat.php.
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
    'live_url'   => ApiCompatibility::DEFAULT_SPEC_URL,

    /*
     * Default snapshot output location for `--snapshot`.
     */
    'snapshot_path' => dirname(__DIR__) . '/build/api-compat-report.json',
];
