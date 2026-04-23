<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Resource;

use miralsoft\synaxon\api\Http\HttpClientInterface;
use miralsoft\synaxon\api\Util\PathBuilder;

/**
 * Shared plumbing for all resource classes.
 */
abstract class AbstractResource
{
    public function __construct(protected readonly HttpClientInterface $http)
    {
    }

    /**
     * Expand a URI template with the supplied path parameters.
     *
     * @param array<string, scalar> $params
     */
    protected function expand(string $template, array $params = []): string
    {
        return PathBuilder::expand($template, $params);
    }

    /**
     * @param array<string, scalar|array<int, scalar>> $query
     * @return array<string, mixed>|list<mixed>|null
     */
    protected function httpGet(string $path, array $query = []): array|null
    {
        return $this->http->request('GET', $path, ['query' => $query]);
    }

    /**
     * @param array<string, mixed>|null $body
     * @param array<string, scalar|array<int, scalar>> $query
     * @return array<string, mixed>|list<mixed>|null
     */
    protected function httpPost(string $path, ?array $body = null, array $query = []): array|null
    {
        return $this->http->request('POST', $path, ['body' => $body, 'query' => $query]);
    }

    /**
     * @param array<string, mixed>|null $body
     * @param array<string, scalar|array<int, scalar>> $query
     * @return array<string, mixed>|list<mixed>|null
     */
    protected function httpPut(string $path, ?array $body = null, array $query = []): array|null
    {
        return $this->http->request('PUT', $path, ['body' => $body, 'query' => $query]);
    }

    /**
     * @param array<string, mixed>|null $body
     * @param array<string, scalar|array<int, scalar>> $query
     * @return array<string, mixed>|list<mixed>|null
     */
    protected function httpPatch(string $path, ?array $body = null, array $query = []): array|null
    {
        return $this->http->request('PATCH', $path, ['body' => $body, 'query' => $query]);
    }

    /**
     * @param array<string, scalar|array<int, scalar>> $query
     * @return array<string, mixed>|list<mixed>|null
     */
    protected function httpDelete(string $path, array $query = []): array|null
    {
        return $this->http->request('DELETE', $path, ['query' => $query]);
    }
}
