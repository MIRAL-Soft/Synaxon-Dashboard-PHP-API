<?php

declare(strict_types=1);

/**
 * Diagnostic script — issues one read call per resource against the live API
 * and prints a compact sample of the returned data so a human can verify
 * the shape and contents are sensible.
 *
 * NEVER committed as a test. Run with:
 *   php bin/live-data-dump.php
 */

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../tests/bootstrap.php';

use miralsoft\synaxon\api\Client\SynaxonClient;
use miralsoft\synaxon\api\Tests\testConfig;

$client = new SynaxonClient(testConfig::resolveBearerConfig());

/**
 * @param callable(): array<string, mixed>|list<mixed>|null $fn
 */
function probe(string $label, callable $fn, int $sampleItems = 1): void
{
    echo "\n────────────────────────────────────────────────────────────\n";
    echo "  {$label}\n";
    echo "────────────────────────────────────────────────────────────\n";
    try {
        $start = microtime(true);
        $r = $fn();
        $ms = (int) ((microtime(true) - $start) * 1000);

        if ($r === null) {
            echo "  (null response)  in {$ms}ms\n";
            return;
        }

        if (isset($r['data']) && is_array($r['data'])) {
            $total = $r['totalItems'] ?? '?';
            echo "  in {$ms}ms — paginated: {$total} total / showing first {$sampleItems}\n";
            $items = array_slice($r['data'], 0, $sampleItems);
            foreach ($items as $i => $item) {
                echo "  --- item " . ($i + 1) . " ---\n";
                printAssoc($item, '    ');
            }
            return;
        }

        if (array_is_list($r)) {
            $total = count($r);
            echo "  in {$ms}ms — list of {$total} items / showing first {$sampleItems}\n";
            foreach (array_slice($r, 0, $sampleItems) as $i => $item) {
                echo "  --- item " . ($i + 1) . " ---\n";
                printAssoc($item, '    ');
            }
            return;
        }

        echo "  in {$ms}ms — single object\n";
        printAssoc($r, '    ');
    } catch (Throwable $e) {
        echo "  FAIL: " . get_class($e) . "\n";
        echo "        " . $e->getMessage() . "\n";
    }
}

/**
 * @param array<int|string, mixed> $arr
 */
function printAssoc(array $arr, string $indent = ''): void
{
    foreach ($arr as $k => $v) {
        $key = is_int($k) ? "[{$k}]" : "{$k}:";
        if (is_array($v)) {
            if (count($v) === 0) {
                echo "{$indent}{$key} []\n";
            } elseif (array_is_list($v)) {
                $first = $v[0] ?? null;
                if (is_scalar($first) || $first === null) {
                    $sample = implode(', ', array_map(static fn ($x) => is_scalar($x) ? (string) $x : gettype($x), array_slice($v, 0, 3)));
                    echo "{$indent}{$key} [" . count($v) . " scalars: {$sample}" . (count($v) > 3 ? ', ...' : '') . "]\n";
                } else {
                    echo "{$indent}{$key} [" . count($v) . " objects]\n";
                    if (count($v) > 0 && is_array($v[0])) {
                        printAssoc($v[0], $indent . '    ');
                    }
                }
            } else {
                echo "{$indent}{$key}\n";
                printAssoc($v, $indent . '    ');
            }
        } else {
            $val = $v === null ? 'null' : (is_bool($v) ? ($v ? 'true' : 'false') : (string) $v);
            if (is_string($val) && strlen($val) > 120) {
                $val = substr($val, 0, 117) . '...';
            }
            echo "{$indent}{$key} {$val}\n";
        }
    }
}

echo "============================================================\n";
echo "  SYNAXON LIVE DATA DUMP\n";
echo "============================================================\n";

// 1. AUTH
probe('auth()->whoAmI()', fn () => $client->auth()->whoAmI());

// 2. AUDIT
probe('audit()->listAuditLogs(limit:1)', fn () => $client->audit()->listAuditLogs(['limit' => 1]));
probe('audit()->findAuditLogOptions()', fn () => $client->audit()->findAuditLogOptions());

// 3. CUSTOMERS
probe('customers()->list(limit:2)', fn () => $client->customers()->list(['limit' => 2]), 2);

// 4. TENANTS
probe('tenants()->getTenantFromContext()', fn () => $client->tenants()->getTenantFromContext());

// 5. PRODUCTS
probe('products()->getAvailable()', fn () => $client->products()->getAvailable(), 2);

// 6. NOTIFICATIONS
probe('notifications()->list(limit:1)', fn () => $client->notifications()->list(['limit' => 1]));
probe('notifications()->getMessageOptions()', fn () => $client->notifications()->getMessageOptions());

// 7. DOWNLOADS
probe('downloads()->list(limit:1)', fn () => $client->downloads()->list(['limit' => 1]));

// 8. PATCHES
probe('patches()->list(limit:1)', fn () => $client->patches()->list(['limit' => 1]));

// 9. ACRONIS
probe('acronis()->listCustomers(limit:1)', fn () => $client->acronis()->listAcronisCustomers(['limit' => 1]));
probe('acronis()->getAcronisPartnerFromContext()', fn () => $client->acronis()->getAcronisPartnerFromContext());

// 10. ESET
probe('eset()->listEsetCustomers(limit:1)', fn () => $client->eset()->listEsetCustomers(['limit' => 1]));
probe('eset()->listEsetPartners()', fn () => $client->eset()->listEsetPartners());

// 11. LYWAND
probe('lywand()->listLywandCustomers(limit:1)', fn () => $client->lywand()->listLywandCustomers(['limit' => 1]));
probe('lywand()->getLywandPartnerFromContext()', fn () => $client->lywand()->getLywandPartnerFromContext());

// 12. MAILSTORE
probe('mailstore()->listInstances()', fn () => $client->mailstore()->listInstances());
probe('mailstore()->listMailboxes()', fn () => $client->mailstore()->listMailboxes());
probe('mailstore()->listArchives()', fn () => $client->mailstore()->listArchives());

// 13. N-SIGHT
probe('nSight()->listNsightSites(limit:1)', fn () => $client->nSight()->listNsightSites(['limit' => 1]));
probe('nSight()->listNsightDevices(limit:1)', fn () => $client->nSight()->listNsightDevices(['limit' => 1]));

// 14. REPORTS
probe('reports()->getPartnerReportSetting()', fn () => $client->reports()->getPartnerReportSetting());

// 15. LAYOUT
probe('layout()->listDashboardLayouts()', fn () => $client->layout()->listDashboardLayouts());

// 16. SUPPORT
probe('support()->listSupportQueries(limit:1)', fn () => $client->support()->listSupportQueries(['limit' => 1]));
probe('support()->listSupportChats(limit:1)', fn () => $client->support()->listSupportChats(['limit' => 1]));

// 17. SALES OPPORTUNITIES
probe('salesOpportunities()->list(limit:1)', fn () => $client->salesOpportunities()->list(['limit' => 1]));

// 18. SEC AUDITOR
probe('secAuditor()->listSecAuditorCustomers(limit:1)', fn () => $client->secAuditor()->listSecAuditorCustomers(['limit' => 1]));

echo "\n============================================================\n";
echo "  DUMP COMPLETE\n";
echo "============================================================\n";
