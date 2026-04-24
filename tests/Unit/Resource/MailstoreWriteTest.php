<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Unit\Resource;

use miralsoft\synaxon\api\Resource\MailstoreResource;
use miralsoft\synaxon\api\Tests\Support\MockHttpClient;
use PHPUnit\Framework\TestCase;

/**
 * Offline unit tests for every mutating /v1/mailstore/* endpoint.
 *
 * Each test issues the call against a MockHttpClient and asserts
 * that the verb, path, body and query match the spec verbatim.
 * Generated from the OpenAPI specification.
 */
final class MailstoreWriteTest extends TestCase
{
    /**
     * Create a new journaling mailbox
     *
     * @synaxon-endpoint POST /v1/mailstore/journaling/mailboxes
     */
    public function testCreateJournalingMailboxHttpControllerCreateJournalingMailbox(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new MailstoreResource($http);

        $resource->createJournalingMailbox(['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('POST', $req['method']);
        self::assertSame('/v1/mailstore/journaling/mailboxes', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
    }

    /**
     * Delete a journaling mailbox
     *
     * @synaxon-endpoint DELETE /v1/mailstore/journaling/mailboxes/{id}
     */
    public function testDeleteJournalingMailboxHttpControllerRemoveJournalingMailbox(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new MailstoreResource($http);

        $resource->removeJournalingMailbox('sample-id-1');

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('DELETE', $req['method']);
        self::assertSame('/v1/mailstore/journaling/mailboxes/sample-id-1', $req['path']);
    }

    /**
     * Update the password of a journaling mailbox
     *
     * @synaxon-endpoint POST /v1/mailstore/journaling/mailboxes/{id}/password
     */
    public function testRefreshJournalingMailboxHttpControllerUpdateJournalingMailboxPassword(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new MailstoreResource($http);

        $resource->updateJournalingMailboxPassword('sample-id-1');

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('POST', $req['method']);
        self::assertSame('/v1/mailstore/journaling/mailboxes/sample-id-1/password', $req['path']);
    }

    /**
     * Create a new mailstore instance
     *
     * @synaxon-endpoint POST /v1/mailstore/instances
     */
    public function testCreateMailstoreInstanceHttpControllerCreateMailstoreInstance(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new MailstoreResource($http);

        $resource->createMailstoreInstance(['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('POST', $req['method']);
        self::assertSame('/v1/mailstore/instances', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
    }

    /**
     * Update a mailstore instance
     *
     * @synaxon-endpoint PATCH /v1/mailstore/instances/{id}
     */
    public function testUpdateMailstoreInstanceHttpControllerUpdateMailstoreInstance(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new MailstoreResource($http);

        $resource->updateMailstoreInstance('sample-id-1', ['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('PATCH', $req['method']);
        self::assertSame('/v1/mailstore/instances/sample-id-1', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
    }

    /**
     * Delete a mailstore instance
     *
     * @synaxon-endpoint DELETE /v1/mailstore/instances/{id}
     */
    public function testDeleteMailstoreInstanceHttpControllerRemoveMailstoreInstance(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new MailstoreResource($http);

        $resource->removeMailstoreInstance('sample-id-1');

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('DELETE', $req['method']);
        self::assertSame('/v1/mailstore/instances/sample-id-1', $req['path']);
    }
}
