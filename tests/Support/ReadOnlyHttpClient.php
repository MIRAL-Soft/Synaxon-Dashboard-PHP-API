<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Support;

use LogicException;
use miralsoft\synaxon\api\Http\HttpClientInterface;

/**
 * Transport guard for the live integration suite: every request passes
 * through here, and anything but GET or HEAD is refused before it leaves the
 * machine. This checks the request that is actually sent, so neither a
 * hand-written test nor a generator mistake can write to the live tenant.
 */
final class ReadOnlyHttpClient implements HttpClientInterface
{
    private const ALLOWED = ['GET', 'HEAD'];

    public function __construct(private readonly HttpClientInterface $inner)
    {
    }

    public function request(string $method, string $path, array $options = []): array|null
    {
        if (!in_array(strtoupper($method), self::ALLOWED, true)) {
            throw new LogicException(sprintf(
                'Integration tests are read-only: refused %s %s before it was sent.',
                strtoupper($method),
                $path
            ));
        }

        return $this->inner->request($method, $path, $options);
    }
}
