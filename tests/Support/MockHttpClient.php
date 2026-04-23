<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Support;

use miralsoft\synaxon\api\Http\HttpClientInterface;

/**
 * Predictable HTTP stub used by unit tests.
 *
 * Records every request and returns canned responses in FIFO order. If the
 * queue is empty an empty array is returned. Tests can therefore assert on
 * captured requests without ever touching the network.
 */
final class MockHttpClient implements HttpClientInterface
{
    /** @var list<array{method:string,path:string,options:array<string,mixed>}> */
    public array $requests = [];

    /** @var list<array<string,mixed>|list<mixed>|null> */
    private array $responses = [];

    /**
     * @param array<string,mixed>|list<mixed>|null $response
     */
    public function queue(array|null $response): self
    {
        $this->responses[] = $response;
        return $this;
    }

    public function request(string $method, string $path, array $options = []): array|null
    {
        $this->requests[] = [
            'method'  => $method,
            'path'    => $path,
            'options' => $options,
        ];

        if ($this->responses === []) {
            return [];
        }

        return array_shift($this->responses);
    }

    public function lastRequest(): ?array
    {
        if ($this->requests === []) {
            return null;
        }
        return $this->requests[count($this->requests) - 1];
    }
}
