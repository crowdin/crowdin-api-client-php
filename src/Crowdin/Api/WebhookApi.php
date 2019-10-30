<?php

namespace Crowdin\Api;

use Crowdin\Model\Webhook;

/**
 * Class WebhookApi
 * @package Crowdin\Api
 */
class WebhookApi extends AbstractApi
{
    public function list()
    {
        return $this->_list('webhooks', Webhook::class);
    }

    /**
     * @param int $webhookId
     * @return Webhook
     */
    public function get(int $webhookId): Webhook
    {
        return $this->_get('webhooks/' . $webhookId, Webhook::class);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->_create('webhooks', Webhook::class, $data);
    }

    /**
     * @param Webhook $webhook
     * @return Webhook|null
     */
    public function update(Webhook $webhook): ?Webhook
    {
        return $this->_update('webhooks', $webhook);
    }

    /***
     * @param int $webhookId
     * @return mixed
     */
    public function delete(int $webhookId)
    {
        return $this->_delete('webhooks/' . $webhookId);
    }
}
