<?php

namespace CrowdinApiClient\Api\Enterprise;

use CrowdinApiClient\Api\AbstractApi;

/**
 * Send notifications
 *
 * @package Crowdin\Api\Enterprise
 */
class NotificationApi extends AbstractApi
{

    /**
     * Send Notification To Organization Members
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.notify.post  API Documentation Enterprise
     *
     * @param array $data
     *  string $data[message] required<br>
     *  string $data[role] Enum: "owner" "admin"<br>
     *  integer[] $data[userIds]
     * @return mixed
     */
    public function sendNotificationToOrganizationMembers(array $data)
    {
        $path = 'notify';

        $options = [
            'body' => json_encode($data),
            'headers' => ['Content-Type' => 'application/json']
        ];

        return $this->client->apiRequest('post', $path, null, $options);
    }
}
