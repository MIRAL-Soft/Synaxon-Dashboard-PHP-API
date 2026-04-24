<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Exception;

/**
 * Thrown when the API rejects credentials (HTTP 401 or 403).
 */
class AuthenticationException extends SynaxonApiException
{
}
