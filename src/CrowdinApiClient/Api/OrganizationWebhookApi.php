<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\OrganizationWebhook;
use CrowdinApiClient\Model\WebhookDelivery;
use CrowdinApiClient\Model\WebhookTestResult;
use CrowdinApiClient\ModelCollection;

/**
 * Webhooks allow you to collect information about events that happen in your Crowdin Enterprise organization.
 * You can select the request type, content type, and add a custom payload, which allows you to create integrations with other systems on your own.
 *
 * @package Crowdin\Api
 */
class OrganizationWebhookApi extends AbstractApi
{
    /**
     * List Organization Webhooks
     * @link https://developer.crowdin.com/api/v2/#operation/api.webhooks.getMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.webhooks.getMany API Documentation Enterprise
     *
     * @param array $params
     * @return ModelCollection
     */
    public function list(array $params = []): ModelCollection
    {
        return $this->_list('webhooks', OrganizationWebhook::class, $params);
    }

    /**
     * Get Organization Webhook
     * @link https://developer.crowdin.com/api/v2/#operation/api.webhooks.get API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.webhooks.get API Documentation Enterprise
     *
     * @param int $organizationWebhookId
     * @return OrganizationWebhook
     */
    public function get(int $organizationWebhookId): OrganizationWebhook
    {
        return $this->_get(sprintf('webhooks/%d', $organizationWebhookId), OrganizationWebhook::class);
    }

    /**
     * Add Organization Webhook
     * @link https://developer.crowdin.com/api/v2/#operation/api.webhooks.post API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.webhooks.post API Documentation Enterprise
     *
     * @param array $data
     *      string $data[name] required<br>
     *      string $data[url] required<br>
     *      string[] $data[events] required Enum: "project.created" "project.deleted" Enterprise onyl enum: "project.created" "project.deleted" "group.created" "group.deleted"<br>
     *      string $data[requestType] required Enum: "POST" "GET"<br>
     *      boolean $data[isActive]<br>
     *      boolean $data[batchingEnabled]<br>
     *      string $data[contentType] Default: "application/json" Enum: "multipart/form-data" "application/json" "application/x-www-form-urlencoded"<br>
     *      array $data[headers]<br>
     *      array $data[payload]
     *
     * @return OrganizationWebhook|null
     */
    public function create(array $data): ?OrganizationWebhook
    {
        return $this->_create('webhooks', OrganizationWebhook::class, $data);
    }

    /**
     * Update Organization Webhook
     * @link https://developer.crowdin.com/api/v2/#operation/api.webhooks.patch API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.webhooks.patch API Documentation Enterprise
     *
     * @param OrganizationWebhook $organizationWebhook
     * @return OrganizationWebhook|null
     */
    public function update(OrganizationWebhook $organizationWebhook): ?OrganizationWebhook
    {
        return $this->_update(sprintf('webhooks/%d', $organizationWebhook->getId()), $organizationWebhook);
    }

    /**
     * Delete Organization Webhook
     * @link https://developer.crowdin.com/api/v2/#operation/api.webhooks.delete API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.webhooks.delete API Documentation Enterprise
     *
     * @param int $organizationWebhookId
     * @return mixed
     */
    public function delete(int $organizationWebhookId)
    {
        return $this->_delete(sprintf('webhooks/%d', $organizationWebhookId));
    }

    /**
     * List All Webhook Deliveries
     * @link https://developer.crowdin.com/api/v2/#operation/api.webhooks.deliveries.getAll API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.webhooks.deliveries.getAll API Documentation Enterprise
     *
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
    public function listAllDeliveries(array $params = []): ModelCollection
    {
        return $this->_list('webhooks/deliveries', WebhookDelivery::class, $params);
    }

    /**
     * List Webhook Deliveries
     * @link https://developer.crowdin.com/api/v2/#operation/api.webhooks.deliveries.getMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.webhooks.deliveries.getMany API Documentation Enterprise
     *
     * @param int $organizationWebhookId
     * @param array $params
     * string $params[status] success or failed<br>
     * string $params[events] One event or comma-separated list<br>
     * string $params[createdAfter] ISO 8601 date<br>
     * string $params[createdBefore] ISO 8601 date<br>
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function listDeliveries(int $organizationWebhookId, array $params = []): ModelCollection
    {
        $path = sprintf('webhooks/%d/deliveries', $organizationWebhookId);
        return $this->_list($path, WebhookDelivery::class, $params);
    }

    /**
     * Get Webhook Delivery
     * @link https://developer.crowdin.com/api/v2/#operation/api.webhooks.deliveries.get API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.webhooks.deliveries.get API Documentation Enterprise
     *
     * @param int $organizationWebhookId
     * @param int $deliveryId
     * @return WebhookDelivery|null
     */
    public function getDelivery(int $organizationWebhookId, int $deliveryId): ?WebhookDelivery
    {
        $path = sprintf('webhooks/%d/deliveries/%d', $organizationWebhookId, $deliveryId);
        return $this->_get($path, WebhookDelivery::class);
    }

    /**
     * Resend Webhook Delivery
     * @link https://developer.crowdin.com/api/v2/#operation/api.webhooks.deliveries.resend.post API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.webhooks.deliveries.resend.post API Documentation Enterprise
     *
     * @param int $organizationWebhookId
     * @param int $deliveryId
     * @return WebhookDelivery|null The new delivery
     */
    public function resendDelivery(int $organizationWebhookId, int $deliveryId): ?WebhookDelivery
    {
        $path = sprintf('webhooks/%d/deliveries/%d/resend', $organizationWebhookId, $deliveryId);
        return $this->_post($path, WebhookDelivery::class, []);
    }

    /**
     * Test Webhook
     * @link https://developer.crowdin.com/api/v2/#operation/api.webhooks.tests.post API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.webhooks.tests.post API Documentation Enterprise
     *
     * @param int $organizationWebhookId
     * @param array $data
     * string $data[event] One of the webhook events. Default is the first event of the webhook
     * @return WebhookTestResult|null
     */
    public function test(int $organizationWebhookId, array $data = []): ?WebhookTestResult
    {
        $path = sprintf('webhooks/%d/tests', $organizationWebhookId);
        return $this->_post($path, WebhookTestResult::class, $data);
    }
}
