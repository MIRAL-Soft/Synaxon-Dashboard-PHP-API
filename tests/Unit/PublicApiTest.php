<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Unit;

use miralsoft\synaxon\api\Tests\Support\PublicApi;
use PHPUnit\Framework\TestCase;

/**
 * The public surface must match the approved list in
 * tests/Fixtures/public-api.txt. A difference is either a bug or an API
 * change that needs a deliberate decision, a CHANGELOG entry and, when
 * something was removed or renamed, a major version.
 */
final class PublicApiTest extends TestCase
{
    public function testPublicApiMatchesTheApprovedList(): void
    {
        $approved = file_exists(PublicApi::FIXTURE) ? (string) file_get_contents(PublicApi::FIXTURE) : '';
        $current = PublicApi::render();

        if ($approved === $current) {
            $this->addToAssertionCount(1);

            return;
        }

        $approvedLines = array_filter(explode("\n", str_replace("\r\n", "\n", $approved)));
        $currentLines = array_filter(explode("\n", $current));
        $removed = array_diff($approvedLines, $currentLines);
        $added = array_diff($currentLines, $approvedLines);

        self::fail(sprintf(
            "The public API changed.\nRemoved or changed (%d):\n  - %s\nAdded (%d):\n  + %s\n"
            . 'If this is intended: note it in CHANGELOG.md (a removal is a major version), then run `composer public-api`.',
            count($removed),
            implode("\n  - ", array_slice($removed, 0, 40)),
            count($added),
            implode("\n  + ", array_slice($added, 0, 40)),
        ));
    }
}
