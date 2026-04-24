<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Integration\ReadOnly;

use miralsoft\synaxon\api\Tests\Integration\IntegrationTestCase;

/**
 * Read-only smoke tests for all GET /v1/mailstore/* endpoints.
 *
 * Generated from the OpenAPI spec. Every test invokes the upstream
 * endpoint and asserts that the response is not an error. Endpoints
 * that require a sample ID draw it from the list endpoint for the
 * same resource.
 */
final class MailstoreReadTest extends IntegrationTestCase
{
    use EndpointSamplingTrait;

    /**
     * List journaling mailboxes
     *
     * @synaxon-endpoint GET /v1/mailstore/journaling/mailboxes
     */
    public function testFindJournalingMailboxesHttpControllerListMailboxes(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->mailstore()->listMailboxes([]);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/mailstore/journaling/mailboxes');
    }

    /**
     * Find journaling mailbox by ID
     *
     * @synaxon-endpoint GET /v1/mailstore/journaling/mailboxes/{id}
     */
    public function testFindJournalingMailboxByIdHttpControllerGetMailboxById(): void
    {
        $this->assertReadOnly('GET');
        $id = $this->sampleId(
            'mailstore:/v1/mailstore/journaling/mailboxes',
            fn () => $this->client->mailstore()->listMailboxes(['limit' => 1]),
        );
        $response = $this->client->mailstore()->getMailboxById($id);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/mailstore/journaling/mailboxes/{id}');
    }

    /**
     * Get all mailstore instances
     *
     * @synaxon-endpoint GET /v1/mailstore/instances
     */
    public function testFindMailstoreInstancesHttpControllerListInstances(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->mailstore()->listInstances([]);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/mailstore/instances');
    }

    /**
     * Check if a mailstore instance alias is available
     *
     * @synaxon-endpoint GET /v1/mailstore/instances/alias-availability
     */
    public function testIsMailstoreAliasAvailableHttpControllerCheckAliasAvailability(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->mailstore()->checkAliasAvailability([]);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/mailstore/instances/alias-availability');
    }

    /**
     * Get mailstore instance by ID
     *
     * @synaxon-endpoint GET /v1/mailstore/instances/{id}
     */
    public function testFindMailstoreInstanceByIdHttpControllerGetInstanceById(): void
    {
        $this->assertReadOnly('GET');
        $id = $this->sampleId(
            'mailstore:/v1/mailstore/instances',
            fn () => $this->client->mailstore()->listInstances(['limit' => 1]),
        );
        $response = $this->client->mailstore()->getInstanceById($id);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/mailstore/instances/{id}');
    }

    /**
     * Get Mailstore instance metrics with comparison
     *
     * @synaxon-endpoint GET /v1/mailstore/instances/{id}/metrics
     */
    public function testGetMailstoreInstanceMetricsHttpControllerGetMailstoreInstanceMetrics(): void
    {
        $this->assertReadOnly('GET');
        $id = $this->sampleId(
            'mailstore:/v1/mailstore/instances',
            fn () => $this->client->mailstore()->listInstances(['limit' => 1]),
        );
        $response = $this->client->mailstore()->getMailstoreInstanceMetrics($id, []);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/mailstore/instances/{id}/metrics');
    }

    /**
     * Get Mailstore partner metrics with comparison
     *
     * @synaxon-endpoint GET /v1/mailstore/metrics
     */
    public function testGetMailstorePartnerMetricsHttpControllerGetMailstorePartnerMetrics(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->mailstore()->getMailstorePartnerMetrics([]);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/mailstore/metrics');
    }

    /**
     * List mailstore archives
     *
     * @synaxon-endpoint GET /v1/mailstore/archives
     */
    public function testFindMailstoreArchivesHttpControllerListArchives(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->mailstore()->listArchives([]);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/mailstore/archives');
    }

    /**
     * Get mailstore profiles
     *
     * @synaxon-endpoint GET /v1/mailstore/profiles
     */
    public function testFindMailstoreProfilesHttpControllerListProfiles(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->mailstore()->listProfiles([]);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/mailstore/profiles');
    }

    /**
     * Get mailstore profile by ID
     *
     * @synaxon-endpoint GET /v1/mailstore/profiles/{id}
     */
    public function testFindMailstoreProfileByIdHttpControllerGetProfileById(): void
    {
        $this->assertReadOnly('GET');
        $id = $this->sampleId(
            'mailstore:/v1/mailstore/profiles',
            fn () => $this->client->mailstore()->listProfiles(['limit' => 1]),
        );
        $response = $this->client->mailstore()->getProfileById($id);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/mailstore/profiles/{id}');
    }

    /**
     * List mailstore profile results
     *
     * @synaxon-endpoint GET /v1/mailstore/profiles/{id}/results
     */
    public function testFindMailstoreProfileResultsHttpControllerListProfileResults(): void
    {
        $this->assertReadOnly('GET');
        $id = $this->sampleId(
            'mailstore:/v1/mailstore/profiles',
            fn () => $this->client->mailstore()->listProfiles(['limit' => 1]),
        );
        $response = $this->client->mailstore()->listProfileResults($id, []);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/mailstore/profiles/{id}/results');
    }
}
