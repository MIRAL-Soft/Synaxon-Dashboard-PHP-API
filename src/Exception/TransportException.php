<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Exception;

/**
 * Thrown when an HTTP request fails before a usable response was produced
 * (network error, DNS failure, TLS handshake failure, timeout, etc.).
 */
class TransportException extends SynaxonApiException
{
}
