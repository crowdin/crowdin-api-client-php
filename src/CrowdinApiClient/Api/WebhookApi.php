<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\Webhook;
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
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.webhooks.getMany API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.webhooks.getMany API Documentation Enterprise
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
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.webhooks.get API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.webhooks.get API Documentation Enterprise
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
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.webhooks.post API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.webhooks.post API Documentation Enterprise
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
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.webhooks.patch API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.webhooks.patch API Documentation Enterprise
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
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.webhooks.delete API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.webhooks.delete API Documentation Enterprise
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
}
