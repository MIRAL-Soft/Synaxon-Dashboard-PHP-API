<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Integration;

use miralsoft\synaxon\api\Compat\ApiCompatibility;
use miralsoft\synaxon\api\Exception\SynaxonApiException;
use miralsoft\synaxon\api\Tests\testConfig;
use PHPUnit\Framework\TestCase;

/**
 * Live compatibility check through the library's own public API: fetches the
 * live OpenAPI document and compares it with Compat\ApiSurface.
 *
 * Skipped when no credentials are configured. The spec itself is public, but
 * the live suite has one on/off switch, governed by tests/.env.test.
 */
final class LiveCompatibilityTest extends TestCase
{
    public function testLibraryMatchesTheLiveSpec(): void
    {
        if (!testConfig::hasCredentials()) {
            self::markTestSkipped('Integration credentials missing in tests/.env.test.');
        }

        try {
            $report = new ApiCompatibility()->compare();
        } catch (SynaxonApiException $e) {
            self::markTestSkipped('Live spec unavailable: ' . $e->getMessage());
        }

        self::assertTrue($report->isCompatible(), sprintf(
            "Live API drift detected.\nMissing in the library (%d):\n  - %s\nRemoved upstream (%d):\n  - %s\n"
            . "Schemas missing (%d): %s\nSchemas removed (%d): %s",
            count($report->missingOperations),
            implode("\n  - ", $report->missingOperations) ?: '(none)',
            count($report->removedOperations),
            implode("\n  - ", $report->removedOperations) ?: '(none)',
            count($report->missingSchemas),
            implode(', ', $report->missingSchemas) ?: '(none)',
            count($report->removedSchemas),
            implode(', ', $report->removedSchemas) ?: '(none)',
        ));
    }
}
