<?php

declare(strict_types=1);

/**
 * Demonstrates the typed exception hierarchy and the correlation-ID
 * helper that ships with every error.
 *
 * Run with:
 *   SYNAXON_BEARER_TOKEN=... php examples/04-error-handling.php
 */

require_once __DIR__ . '/../vendor/autoload.php';

use miralsoft\synaxon\api\Client\SynaxonClient;
use miralsoft\synaxon\api\Config\SynaxonConfig;
use miralsoft\synaxon\api\Exception\AuthenticationException;
use miralsoft\synaxon\api\Exception\NotFoundException;
use miralsoft\synaxon\api\Exception\RateLimitException;
use miralsoft\synaxon\api\Exception\ServerException;
use miralsoft\synaxon\api\Exception\SynaxonApiException;
use miralsoft\synaxon\api\Exception\TransportException;
use miralsoft\synaxon\api\Exception\ValidationException;

$client = new SynaxonClient(SynaxonConfig::fromEnv());

try {
    $client->customers()->find('does-not-exist');
} catch (AuthenticationException $e) {
    echo 'Auth failed: ', $e->getMessage(), "\n";
} catch (NotFoundException $e) {
    echo 'Not found: ', $e->getMessage(), "\n";
    echo 'Correlation ID for support: ', $e->getCorrelationId() ?? '(none)', "\n";
} catch (RateLimitException $e) {
    echo 'Rate-limited; retry after ', $e->getRetryAfter() ?? '?', "s\n";
} catch (ValidationException $e) {
    echo 'Validation failed: ', json_encode($e->getErrors()), "\n";
} catch (ServerException $e) {
    echo 'Server error: ', $e->getMessage(), "\n";
} catch (TransportException $e) {
    echo 'Network/TLS error: ', $e->getMessage(), "\n";
} catch (SynaxonApiException $e) {
    echo 'Other API error: ', $e->getMessage(), "\n";
}
