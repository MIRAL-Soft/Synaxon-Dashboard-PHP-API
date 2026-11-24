<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Exception;

/**
 * Thrown when a response lacks a field the API specification declares as
 * required. The getter refuses to invent a value (an empty string or 0) that
 * would look like real data.
 */
class UnexpectedResponseException extends SynaxonApiException
{
}
