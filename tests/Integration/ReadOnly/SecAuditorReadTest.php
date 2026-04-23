<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Integration\ReadOnly;

use miralsoft\synaxon\api\Tests\Integration\IntegrationTestCase;

/**
 * Read-only smoke tests for all GET /v1/sec-auditor/* endpoints.
 *
 * Generated from the OpenAPI spec. Every test invokes the upstream
 * endpoint and asserts that the response is not an error. Endpoints
 * that require a sample ID draw it from the list endpoint for the
 * same resource.
 */
final class SecAuditorReadTest extends IntegrationTestCase
{
    use EndpointSamplingTrait;

    /**
     * List SEC AUDITOR customers
     *
     * @synaxon-endpoint GET /v1/sec-auditor/customers
     */
    public function testFindSecAuditorCustomersHttpControllerListSecAuditorCustomers(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->secAuditor()->listSecAuditorCustomers([]);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/sec-auditor/customers');
    }

    /**
     * Get SEC AUDITOR customer by id
     *
     * @synaxon-endpoint GET /v1/sec-auditor/customers/{id}
     */
    public function testFindSecAuditorCustomerHttpControllerGetSecAuditorCustomer(): void
    {
        $this->assertReadOnly('GET');
        $id = $this->sampleId(
            'sec-auditor:/v1/sec-auditor/customers',
            fn () => $this->client->secAuditor()->listSecAuditorCustomers(["limit" => 1]),
        );
        $response = $this->client->secAuditor()->getSecAuditorCustomer($id);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/sec-auditor/customers/{id}');
    }

    /**
     * Create SEC AUDITOR customer installer
     *
     * @synaxon-endpoint GET /v1/sec-auditor/customers/{id}/installer
     */
    public function testCreateSecAuditorInstallerHttpControllerCreateSecAuditorInstaller(): void
    {
        $this->assertReadOnly('GET');
        self::markTestSkipped('Returns installer binary + requires OS query parameter.');
    }
}
