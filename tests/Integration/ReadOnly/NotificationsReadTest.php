<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Integration\ReadOnly;

use miralsoft\synaxon\api\Tests\Integration\IntegrationTestCase;

/**
 * Read-only smoke tests for all GET /v1/notifications/* endpoints.
 *
 * Generated from the OpenAPI spec. Every test invokes the upstream
 * endpoint and asserts that the response is not an error. Endpoints
 * that require a sample ID draw it from the list endpoint for the
 * same resource.
 */
final class NotificationsReadTest extends IntegrationTestCase
{
    use EndpointSamplingTrait;

    /**
     * Get messages
     *
     * @synaxon-endpoint GET /v1/notifications
     */
    public function testFindMessagesHttpControllerListMessages(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->notifications()->list([]);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/notifications');
    }

    /**
     * Get unread messages
     *
     * @synaxon-endpoint GET /v1/notifications/unread
     */
    public function testFindUnreadMessagesHttpControllerListUnreadMessages(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->notifications()->listUnreadMessages([]);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/notifications/unread');
    }

    /**
     * Get message options
     *
     * @synaxon-endpoint GET /v1/notifications/options
     */
    public function testFindMessageOptionsHttpControllerGetMessageOptions(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->notifications()->getMessageOptions();
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/notifications/options');
    }

    /**
     * Get message by id
     *
     * @synaxon-endpoint GET /v1/notifications/{id}
     */
    public function testFindMessageHttpControllerGetMessage(): void
    {
        $this->assertReadOnly('GET');
        $id = $this->sampleId(
            'notifications:/v1/notifications',
            fn () => $this->client->notifications()->list(["limit" => 1]),
        );
        $response = $this->client->notifications()->find($id);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/notifications/{id}');
    }
}
