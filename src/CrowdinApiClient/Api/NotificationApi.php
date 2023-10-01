<?php

namespace CrowdinApiClient\Api;

/**
 * Send notifications
 *
 * @package Crowdin\Api
 */
class NotificationApi extends AbstractApi
{
    /**
     * Send Notification to Authenticated User
     * @link https://developer.crowdin.com/api/v2/#operation/api.notify.post  API Documentation
     *
     * @param array $data
     *  string $data[message] required
     * @return mixed
     */
    public function sendToAuthenticatedUser(array $data)
    {
        $path = 'notify';

        $options = [
            'body' => json_encode($data),
            'headers' => ['Content-Type' => 'application/json']
        ];

        return $this->client->apiRequest('post', $path, null, $options);

    }

    /**
     * Send Notification To Project Members
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.notify.post  API Documentation
     *
     * @param int $projectId
     * @param array $data
     *  string $data[message] required<br>
     *  string $data[role] Enum: "owner" "manager"<br>
     *  integer[] $data[userIds]
     * @return mixed
     */
    public function sendNotificationToProjectMembers(int $projectId, array $data)
    {
        $path = sprintf('projects/%s/notify', $projectId);

        $options = [
            'body' => json_encode($data),
            'headers' => ['Content-Type' => 'application/json']
        ];

        return $this->client->apiRequest('post', $path, null, $options);
    }
}
