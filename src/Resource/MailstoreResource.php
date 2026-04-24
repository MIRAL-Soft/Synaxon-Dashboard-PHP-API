<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Resource;

/**
 * Mailstore resource — wraps all /v1/mailstore/* endpoints.
 *
 * This class is generated from the OpenAPI specification. Method names follow
 * REST conventions where the endpoint shape permits; otherwise the suffix of
 * the upstream operationId is used to preserve semantic meaning.
 */
class MailstoreResource extends AbstractResource
{
    /**
     * List journaling mailboxes
     *
     * @synaxon-endpoint GET /v1/mailstore/journaling/mailboxes
     * @synaxon-operation-id FindJournalingMailboxesHttpController_listMailboxes
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function listMailboxes(array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/mailstore/journaling/mailboxes'), $query);
    }

    /**
     * Create a new journaling mailbox
     *
     * @synaxon-endpoint POST /v1/mailstore/journaling/mailboxes
     * @synaxon-operation-id CreateJournalingMailboxHttpController_createJournalingMailbox
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function createJournalingMailbox(?array $body = null): array|null
    {
        return $this->httpPost($this->expand('/v1/mailstore/journaling/mailboxes'), $body);
    }

    /**
     * Find journaling mailbox by ID
     *
     * @synaxon-endpoint GET /v1/mailstore/journaling/mailboxes/{id}
     * @synaxon-operation-id FindJournalingMailboxByIdHttpController_getMailboxById
     * @param string $id Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getMailboxById(string $id): array|null
    {
        return $this->httpGet($this->expand('/v1/mailstore/journaling/mailboxes/{id}', ['id' => $id]));
    }

    /**
     * Delete a journaling mailbox
     *
     * @synaxon-endpoint DELETE /v1/mailstore/journaling/mailboxes/{id}
     * @synaxon-operation-id DeleteJournalingMailboxHttpController_removeJournalingMailbox
     * @param string $id Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function removeJournalingMailbox(string $id): array|null
    {
        return $this->httpDelete($this->expand('/v1/mailstore/journaling/mailboxes/{id}', ['id' => $id]));
    }

    /**
     * Update the password of a journaling mailbox
     *
     * @synaxon-endpoint POST /v1/mailstore/journaling/mailboxes/{id}/password
     * @synaxon-operation-id RefreshJournalingMailboxHttpController_updateJournalingMailboxPassword
     * @param string $id Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function updateJournalingMailboxPassword(string $id): array|null
    {
        return $this->httpPost($this->expand('/v1/mailstore/journaling/mailboxes/{id}/password', ['id' => $id]), null);
    }

    /**
     * Get all mailstore instances
     *
     * @synaxon-endpoint GET /v1/mailstore/instances
     * @synaxon-operation-id FindMailstoreInstancesHttpController_listInstances
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function listInstances(array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/mailstore/instances'), $query);
    }

    /**
     * Create a new mailstore instance
     *
     * @synaxon-endpoint POST /v1/mailstore/instances
     * @synaxon-operation-id CreateMailstoreInstanceHttpController_createMailstoreInstance
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function createMailstoreInstance(?array $body = null): array|null
    {
        return $this->httpPost($this->expand('/v1/mailstore/instances'), $body);
    }

    /**
     * Check if a mailstore instance alias is available
     *
     * @synaxon-endpoint GET /v1/mailstore/instances/alias-availability
     * @synaxon-operation-id IsMailstoreAliasAvailableHttpController_checkAliasAvailability
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function checkAliasAvailability(array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/mailstore/instances/alias-availability'), $query);
    }

    /**
     * Get mailstore instance by ID
     *
     * @synaxon-endpoint GET /v1/mailstore/instances/{id}
     * @synaxon-operation-id FindMailstoreInstanceByIdHttpController_getInstanceById
     * @param string $id Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getInstanceById(string $id): array|null
    {
        return $this->httpGet($this->expand('/v1/mailstore/instances/{id}', ['id' => $id]));
    }

    /**
     * Update a mailstore instance
     *
     * @synaxon-endpoint PATCH /v1/mailstore/instances/{id}
     * @synaxon-operation-id UpdateMailstoreInstanceHttpController_updateMailstoreInstance
     * @param string $id Path parameter from the upstream spec.
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function updateMailstoreInstance(string $id, ?array $body = null): array|null
    {
        return $this->httpPatch($this->expand('/v1/mailstore/instances/{id}', ['id' => $id]), $body);
    }

    /**
     * Delete a mailstore instance
     *
     * @synaxon-endpoint DELETE /v1/mailstore/instances/{id}
     * @synaxon-operation-id DeleteMailstoreInstanceHttpController_removeMailstoreInstance
     * @param string $id Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function removeMailstoreInstance(string $id): array|null
    {
        return $this->httpDelete($this->expand('/v1/mailstore/instances/{id}', ['id' => $id]));
    }

    /**
     * Get Mailstore instance metrics with comparison — Retrieves current real-time metrics for an
     * instance and compares them with the most recent historical metric. Optionally specify a date to
     * compare against a specific historical point.
     *
     * @synaxon-endpoint GET /v1/mailstore/instances/{id}/metrics
     * @synaxon-operation-id GetMailstoreInstanceMetricsHttpController_getMailstoreInstanceMetrics
     * @param string $id Path parameter from the upstream spec.
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getMailstoreInstanceMetrics(string $id, array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/mailstore/instances/{id}/metrics', ['id' => $id]), $query);
    }

    /**
     * Get Mailstore partner metrics with comparison — Retrieves current real-time metrics for the
     * partner (aggregated across all instances) and compares them with the most recent historical metric.
     * Optionally specify a date to compare against a specific historical point.
     *
     * @synaxon-endpoint GET /v1/mailstore/metrics
     * @synaxon-operation-id GetMailstorePartnerMetricsHttpController_getMailstorePartnerMetrics
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getMailstorePartnerMetrics(array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/mailstore/metrics'), $query);
    }

    /**
     * List mailstore archives
     *
     * @synaxon-endpoint GET /v1/mailstore/archives
     * @synaxon-operation-id FindMailstoreArchivesHttpController_listArchives
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function listArchives(array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/mailstore/archives'), $query);
    }

    /**
     * Get mailstore profiles
     *
     * @synaxon-endpoint GET /v1/mailstore/profiles
     * @synaxon-operation-id FindMailstoreProfilesHttpController_listProfiles
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function listProfiles(array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/mailstore/profiles'), $query);
    }

    /**
     * Get mailstore profile by ID
     *
     * @synaxon-endpoint GET /v1/mailstore/profiles/{id}
     * @synaxon-operation-id FindMailstoreProfileByIdHttpController_getProfileById
     * @param string $id Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getProfileById(string $id): array|null
    {
        return $this->httpGet($this->expand('/v1/mailstore/profiles/{id}', ['id' => $id]));
    }

    /**
     * List mailstore profile results
     *
     * @synaxon-endpoint GET /v1/mailstore/profiles/{id}/results
     * @synaxon-operation-id FindMailstoreProfileResultsHttpController_listProfileResults
     * @param string $id Path parameter from the upstream spec.
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function listProfileResults(string $id, array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/mailstore/profiles/{id}/results', ['id' => $id]), $query);
    }
}
