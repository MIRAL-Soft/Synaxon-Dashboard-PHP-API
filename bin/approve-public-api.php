<?php

declare(strict_types=1);

/**
 * Approve the current public API surface: writes tests/Fixtures/public-api.txt,
 * which PublicApiTest compares against. Run it only after checking that every
 * difference the test reported is intended and noted in CHANGELOG.md.
 *
 * Usage: php bin/approve-public-api.php
 */

require_once dirname(__DIR__) . '/vendor/autoload.php';

use miralsoft\synaxon\api\Tests\Support\PublicApi;

$surface = PublicApi::render();
file_put_contents(PublicApi::FIXTURE, $surface);
printf("Approved %d public methods in tests/Fixtures/public-api.txt\n", substr_count($surface, "\n"));
