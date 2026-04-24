<?php

declare(strict_types=1);

/**
 * Quick start: instantiate the client with a bearer token and read a
 * single response from the live API.
 *
 * Run with:
 *   SYNAXON_BEARER_TOKEN=... php examples/01-quickstart.php
 */

require_once __DIR__ . '/../vendor/autoload.php';

use miralsoft\synaxon\api\Client\SynaxonClient;
use miralsoft\synaxon\api\Config\SynaxonConfig;

$bearer = getenv('SYNAXON_BEARER_TOKEN');
if ($bearer === false || $bearer === '') {
    fwrite(STDERR, "SYNAXON_BEARER_TOKEN env var is required\n");
    exit(1);
}

$client = new SynaxonClient(new SynaxonConfig(bearerToken: $bearer));

$me = $client->auth()->whoAmI();

echo 'Logged in as: ', $me['username'] ?? '?', "\n";
echo 'Tenant ID:    ', $me['tenantId'] ?? '?', "\n";
echo 'Role:         ', $me['role'] ?? '?', "\n";
