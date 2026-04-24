<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Exception;

/**
 * Thrown when the API returns a server-side error (HTTP 5xx).
 */
class ServerException extends SynaxonApiException
{
}
