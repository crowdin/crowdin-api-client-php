<?php

namespace Crowdin\Api;

use Crowdin\Model\Webhook;

/**
 * Class WebhookApi
 * @package Crowdin\Api
 */
class WebhookApi extends AbstractApi
{
    /**
     * @param int $projectId
     * @param array $params
     * @return mixed
     */
    public function list(int $projectId, array $params = [])
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
     * @param int $webhookId
     * @param array $data
     * @return mixed
     */
    public function create(int $projectId, int $webhookId, array $data)
    {
        $patch = sprintf('projects/%d/webhooks/%d', $projectId, $webhookId);
        return $this->_create('webhooks', Webhook::class, $data);
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
