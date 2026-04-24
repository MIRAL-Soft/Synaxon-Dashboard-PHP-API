<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Integration\ReadOnly;

use miralsoft\synaxon\api\Tests\Integration\IntegrationTestCase;

/**
 * Read-only smoke tests for all GET /v1/support/* endpoints.
 *
 * Generated from the OpenAPI spec. Every test invokes the upstream
 * endpoint and asserts that the response is not an error. Endpoints
 * that require a sample ID draw it from the list endpoint for the
 * same resource.
 */
final class SupportReadTest extends IntegrationTestCase
{
    /**
     * List support queries
     *
     * @synaxon-endpoint GET /v1/support/queries
     */
    public function testFindSupportQueriesHttpControllerListSupportQueries(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->support()->listSupportQueries([]);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/support/queries');
    }

    /**
     * List support chat threads
     *
     * @synaxon-endpoint GET /v1/support/chats
     */
    public function testFindSupportChatListHttpControllerListSupportChats(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->support()->listSupportChats([]);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/support/chats');
    }
}
