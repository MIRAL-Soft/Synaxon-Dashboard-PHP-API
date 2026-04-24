<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Integration\ReadOnly;

use miralsoft\synaxon\api\Tests\Integration\IntegrationTestCase;

/**
 * Read-only smoke tests for all GET /v1/system-tasks/* endpoints.
 *
 * Generated from the OpenAPI spec. Every test invokes the upstream
 * endpoint and asserts that the response is not an error. Endpoints
 * that require a sample ID draw it from the list endpoint for the
 * same resource.
 */
final class SystemTasksReadTest extends IntegrationTestCase
{
    use EndpointSamplingTrait;

    /**
     * Get system task by id
     *
     * @synaxon-endpoint GET /v1/system-tasks/{id}
     */
    public function testFindSystemTaskByIdHttpControllerGetSystemTaskById(): void
    {
        $this->assertReadOnly('GET');
        self::markTestSkipped('No list endpoint available in this resource to sample an ID from.');
    }
}
