<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api;

/**
 * The one authoritative library version inside the code.
 *
 * Everything else is derived from it (the default User-Agent) or checked
 * against it automatically: the unit suite compares it with the newest
 * released CHANGELOG section, and the release workflow refuses a tag that
 * does not match it.
 */
final class Version
{
    public const VERSION = '2.0.0';

    private function __construct()
    {
    }
}
