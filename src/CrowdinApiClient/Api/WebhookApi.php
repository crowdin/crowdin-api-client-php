<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\Webhook;
use CrowdinApiClient\ModelCollection;

/**
 * Class WebhookApi
 * @package Crowdin\Api
 */
class WebhookApi extends AbstractApi
{
    /**
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
     * @param int $projectId
     * @param array $data
     * @internal string $data[name] required
     * @internal string $data[url] required
     * @internal array $data[events] required
     * Items Enum:
     * "file.translated"
     * "file.approved"
     * "project.translated"
     * "project.approved"
     * "translation.updated"
     * "suggestion.added"
     * "suggestion.updated"
     * "suggestion.deleted"
     * "suggestion.approved"
     * "suggestion.disapproved"
     * @internal string $data[requestType] required
     * @internal string $data[isActive]
     * @internal string $data[contentType]
     * @internal string $data[headers]
     * @internal string $data[payload]
     * @return Webhook|null
     */
    public function create(int $projectId, array $data): ?Webhook
    {
        $patch = sprintf('projects/%d/webhooks', $projectId);
        return $this->_create($patch, Webhook::class, $data);
    }

    /**
     * @param Webhook $webhook
     * @return Webhook|null
     */
    public function update(Webhook $webhook): ?Webhook
    {
        $patch = sprintf('projects/%d/webhooks/%d', $webhook->getProjectId(), $webhook->getId());
        return $this->_update($patch, $webhook);
    }

    /***
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
