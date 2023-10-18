<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\OrganizationWebhook;
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
}
