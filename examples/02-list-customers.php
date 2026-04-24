<?php

declare(strict_types=1);

/**
 * List the first page of customers and hydrate the response into a
 * typed CustomerPaginatedResponseDto.
 *
 * Run with:
 *   SYNAXON_BEARER_TOKEN=... php examples/02-list-customers.php
 */

require_once __DIR__ . '/../vendor/autoload.php';

use miralsoft\synaxon\api\Client\SynaxonClient;
use miralsoft\synaxon\api\Config\SynaxonConfig;
use miralsoft\synaxon\api\DTO\CustomerPaginatedResponseDto;

$client = new SynaxonClient(SynaxonConfig::fromEnv());

$response = $client->customers()->list(['limit' => 5]);
$page = CustomerPaginatedResponseDto::fromArray($response);

printf(
    "Tenant has %d customers — showing first %d:\n\n",
    (int) $page->getTotalItems(),
    count($page->getData())
);

foreach ($page->getData() as $customer) {
    printf(
        "  [%s] %s — %s, %s %s\n",
        $customer->getId(),
        $customer->getName() ?? '?',
        $customer->getStreet() ?? '-',
        $customer->getPostalCode() ?? '-',
        $customer->getCity() ?? '-',
    );
}
