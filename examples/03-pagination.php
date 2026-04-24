<?php

declare(strict_types=1);

/**
 * Walk the entire customer list using PaginationIterator.
 *
 * The iterator stops automatically when the server returns a short page
 * (or an empty one). It also has a hard MAX_PAGES safety break so a
 * misbehaving server cannot pin the process forever.
 *
 * Run with:
 *   SYNAXON_BEARER_TOKEN=... php examples/03-pagination.php
 */

require_once __DIR__ . '/../vendor/autoload.php';

use miralsoft\synaxon\api\Client\SynaxonClient;
use miralsoft\synaxon\api\Config\SynaxonConfig;
use miralsoft\synaxon\api\Util\PaginationIterator;

$client = new SynaxonClient(SynaxonConfig::fromEnv());

$iter = new PaginationIterator(
    fetch: function (int $page, int $limit) use ($client): array {
        $r = $client->customers()->list(['page' => $page, 'limit' => $limit]);
        return is_array($r['data'] ?? null) ? $r['data'] : [];
    },
    limit: 100,
);

$count = 0;
foreach ($iter as $row) {
    $count++;
    if ($count <= 3) {
        printf("  [%s] %s\n", $row['id'] ?? '?', $row['name'] ?? '?');
    }
    if ($count === 4) {
        echo "  ...\n";
    }
}

echo "\nTotal customers iterated: {$count}\n";
