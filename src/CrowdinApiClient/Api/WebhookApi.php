<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\Webhook;
use CrowdinApiClient\Model\WebhookDelivery;
use CrowdinApiClient\Model\WebhookTestResult;
use CrowdinApiClient\ModelCollection;

/**
 * Webhooks allow you to collect information about events that happen in your Crowdin projects.
 * You can select the request type, content type, and add a custom payload, which allows you to create integrations with other systems on your own.
 *
 * @package Crowdin\Api
 */
class WebhookApi extends AbstractApi
{
    /**
     * List Webhooks
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.webhooks.getMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.webhooks.getMany API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $params
     * @return ModelCollection
     */
    public function list(int $projectId, array $params = []): ModelCollection
    {
        $patch = sprintf('projects/%d/webhooks', $projectId);
        return $this->_list($patch, Webhook::class, $params);
    }

    /**
     * Get Webhook Info
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.webhooks.get API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.webhooks.get API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $webhookId
     * @return Webhook
     */
    public function get(int $projectId, int $webhookId): Webhook
    {
        $patch = sprintf('projects/%d/webhooks/%d', $projectId, $webhookId);
        return $this->_get($patch, Webhook::class);
    }

    /**
     * Add Webhook
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.webhooks.post API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.webhooks.post API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $data
     * string $data[name] required<br>
     * string $data[url] required<br>
     * array $data[events] required<br>
     * string $data[requestType] required<br>
     * boolean $data[isActive]<br>
     * string $data[contentType]<br>
     * array $data[headers]<br>
     * array $data[payload]
     * @return Webhook|null
     */
    public function create(int $projectId, array $data): ?Webhook
    {
        $patch = sprintf('projects/%d/webhooks', $projectId);
        return $this->_create($patch, Webhook::class, $data);
    }

    /**
     * Edit Webhook
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.webhooks.patch API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.webhooks.patch API Documentation Enterprise
     *
     * @param Webhook $webhook
     * @return Webhook|null
     */
    public function update(Webhook $webhook): ?Webhook
    {
        $patch = sprintf('projects/%d/webhooks/%d', $webhook->getProjectId(), $webhook->getId());
        return $this->_update($patch, $webhook);
    }

    /**
     * Delete Webhook
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.webhooks.delete API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.webhooks.delete API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $webhookId
     * @return mixed
     */
    public function delete(int $projectId, int $webhookId)
    {
        $patch = sprintf('projects/%d/webhooks/%d', $projectId, $webhookId);
        return $this->_delete($patch);
    }

    /**
     * List All Webhook Deliveries
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.webhooks.deliveries.getAll API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.webhooks.deliveries.getAll API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $params
     * string $params[webhookIds] One ID or comma-separated list, deleted webhooks included<br>
     * string $params[status] success or failed<br>
     * string $params[events] One event or comma-separated list<br>
     * string $params[createdAfter] ISO 8601 date<br>
     * string $params[createdBefore] ISO 8601 date<br>
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function listAllDeliveries(int $projectId, array $params = []): ModelCollection
    {
        return $this->_list(sprintf('projects/%d/webhooks/deliveries', $projectId), WebhookDelivery::class, $params);
    }

    /**
     * List Webhook Deliveries
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.webhooks.deliveries.getMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.webhooks.deliveries.getMany API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $webhookId
     * @param array $params
     * string $params[status] success or failed<br>
     * string $params[events] One event or comma-separated list<br>
     * string $params[createdAfter] ISO 8601 date<br>
     * string $params[createdBefore] ISO 8601 date<br>
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function listDeliveries(int $projectId, int $webhookId, array $params = []): ModelCollection
    {
        $path = sprintf('projects/%d/webhooks/%d/deliveries', $projectId, $webhookId);
        return $this->_list($path, WebhookDelivery::class, $params);
    }

    /**
     * Get Webhook Delivery
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.webhooks.deliveries.get API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.webhooks.deliveries.get API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $webhookId
     * @param int $deliveryId
     * @return WebhookDelivery|null
     */
    public function getDelivery(int $projectId, int $webhookId, int $deliveryId): ?WebhookDelivery
    {
        $path = sprintf('projects/%d/webhooks/%d/deliveries/%d', $projectId, $webhookId, $deliveryId);
        return $this->_get($path, WebhookDelivery::class);
    }

    /**
     * Resend Webhook Delivery
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.webhooks.deliveries.resend.post API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.webhooks.deliveries.resend.post API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $webhookId
     * @param int $deliveryId
     * @return WebhookDelivery|null The new delivery
     */
    public function resendDelivery(int $projectId, int $webhookId, int $deliveryId): ?WebhookDelivery
    {
        $path = sprintf('projects/%d/webhooks/%d/deliveries/%d/resend', $projectId, $webhookId, $deliveryId);
        return $this->_post($path, WebhookDelivery::class, []);
    }

    /**
     * Test Webhook
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.webhooks.tests.post API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.webhooks.tests.post API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $webhookId
     * @param array $data
     * string $data[event] One of the webhook events. Default is the first event of the webhook
     * @return WebhookTestResult|null
     */
    public function test(int $projectId, int $webhookId, array $data = []): ?WebhookTestResult
    {
        $path = sprintf('projects/%d/webhooks/%d/tests', $projectId, $webhookId);
        return $this->_post($path, WebhookTestResult::class, $data);
    }
}
