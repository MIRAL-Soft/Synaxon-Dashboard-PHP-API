<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Client;

use Psr\Log\LoggerInterface;
use miralsoft\synaxon\api\Config\SynaxonConfig;
use miralsoft\synaxon\api\Http\GuzzleHttpClient;
use miralsoft\synaxon\api\Http\HttpClientInterface;
use miralsoft\synaxon\api\Resource\AcronisResource;
use miralsoft\synaxon\api\Resource\AuditResource;
use miralsoft\synaxon\api\Resource\AuthResource;
use miralsoft\synaxon\api\Resource\CustomersResource;
use miralsoft\synaxon\api\Resource\DownloadsResource;
use miralsoft\synaxon\api\Resource\EsetResource;
use miralsoft\synaxon\api\Resource\LayoutResource;
use miralsoft\synaxon\api\Resource\LywandResource;
use miralsoft\synaxon\api\Resource\MailstoreResource;
use miralsoft\synaxon\api\Resource\NSightResource;
use miralsoft\synaxon\api\Resource\NotificationsResource;
use miralsoft\synaxon\api\Resource\PatchesResource;
use miralsoft\synaxon\api\Resource\ProductsResource;
use miralsoft\synaxon\api\Resource\PusherResource;
use miralsoft\synaxon\api\Resource\ReportsResource;
use miralsoft\synaxon\api\Resource\SalesOpportunitiesResource;
use miralsoft\synaxon\api\Resource\SecAuditorResource;
use miralsoft\synaxon\api\Resource\SupportResource;
use miralsoft\synaxon\api\Resource\SystemTasksResource;
use miralsoft\synaxon\api\Resource\TenantsResource;
use miralsoft\synaxon\api\Resource\UsersResource;

/**
 * SYNAXON Marketplace API client facade.
 *
 * Provides fluent factory methods for every top-level resource group.
 * Authentication, retry and logging behaviour are controlled by the
 * SynaxonConfig passed to the constructor.
 */
final class SynaxonClient
{
    private readonly HttpClientInterface $http;

    private ?AcronisResource $acronis = null;
    private ?AuditResource $audit = null;
    private ?AuthResource $auth = null;
    private ?CustomersResource $customers = null;
    private ?DownloadsResource $downloads = null;
    private ?EsetResource $eset = null;
    private ?LayoutResource $layout = null;
    private ?LywandResource $lywand = null;
    private ?MailstoreResource $mailstore = null;
    private ?NSightResource $nSight = null;
    private ?NotificationsResource $notifications = null;
    private ?PatchesResource $patches = null;
    private ?ProductsResource $products = null;
    private ?PusherResource $pusher = null;
    private ?ReportsResource $reports = null;
    private ?SalesOpportunitiesResource $salesOpportunities = null;
    private ?SecAuditorResource $secAuditor = null;
    private ?SupportResource $support = null;
    private ?SystemTasksResource $systemTasks = null;
    private ?TenantsResource $tenants = null;
    private ?UsersResource $users = null;

    public function __construct(
        SynaxonConfig $config,
        ?HttpClientInterface $http = null,
        ?LoggerInterface $logger = null,
    ) {
        $this->http = $http ?? new GuzzleHttpClient($config, null, $logger);
    }

    public function acronis(): AcronisResource
    {
        return $this->acronis ??= new AcronisResource($this->http);
    }

    public function audit(): AuditResource
    {
        return $this->audit ??= new AuditResource($this->http);
    }

    public function auth(): AuthResource
    {
        return $this->auth ??= new AuthResource($this->http);
    }

    public function customers(): CustomersResource
    {
        return $this->customers ??= new CustomersResource($this->http);
    }

    public function downloads(): DownloadsResource
    {
        return $this->downloads ??= new DownloadsResource($this->http);
    }

    public function eset(): EsetResource
    {
        return $this->eset ??= new EsetResource($this->http);
    }

    public function layout(): LayoutResource
    {
        return $this->layout ??= new LayoutResource($this->http);
    }

    public function lywand(): LywandResource
    {
        return $this->lywand ??= new LywandResource($this->http);
    }

    public function mailstore(): MailstoreResource
    {
        return $this->mailstore ??= new MailstoreResource($this->http);
    }

    public function nSight(): NSightResource
    {
        return $this->nSight ??= new NSightResource($this->http);
    }

    public function notifications(): NotificationsResource
    {
        return $this->notifications ??= new NotificationsResource($this->http);
    }

    public function patches(): PatchesResource
    {
        return $this->patches ??= new PatchesResource($this->http);
    }

    public function products(): ProductsResource
    {
        return $this->products ??= new ProductsResource($this->http);
    }

    public function pusher(): PusherResource
    {
        return $this->pusher ??= new PusherResource($this->http);
    }

    public function reports(): ReportsResource
    {
        return $this->reports ??= new ReportsResource($this->http);
    }

    public function salesOpportunities(): SalesOpportunitiesResource
    {
        return $this->salesOpportunities ??= new SalesOpportunitiesResource($this->http);
    }

    public function secAuditor(): SecAuditorResource
    {
        return $this->secAuditor ??= new SecAuditorResource($this->http);
    }

    public function support(): SupportResource
    {
        return $this->support ??= new SupportResource($this->http);
    }

    public function systemTasks(): SystemTasksResource
    {
        return $this->systemTasks ??= new SystemTasksResource($this->http);
    }

    public function tenants(): TenantsResource
    {
        return $this->tenants ??= new TenantsResource($this->http);
    }

    public function users(): UsersResource
    {
        return $this->users ??= new UsersResource($this->http);
    }
}
