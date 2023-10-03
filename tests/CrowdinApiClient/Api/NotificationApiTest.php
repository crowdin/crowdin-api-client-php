<?php

namespace CrowdinApiClient\Tests\Api;

class NotificationApiTest extends AbstractTestApi
{

    public function testSendToAuthenticatedUser()
    {
        $params = [
            'message' => 'New notification message',
        ];

        $this->mockRequest([
            'method' => 'post',
            'uri' => 'https://api.crowdin.com/api/v2/notify',
            'body' => json_encode($params),
            'response' => null
        ]);

        $this->crowdin->notification->sendToAuthenticatedUser($params);
    }

    public function testSendNotificationToProjectMembers()
    {
        $params = [
            'message' => 'New notification message',
            'userIds' => [1]
        ];

        $this->mockRequest([
            'method' => 'post',
            'uri' => 'https://api.crowdin.com/api/v2/projects/2/notify',
            'body' => json_encode($params),
            'response' => null
        ]);

        $this->crowdin->notification->sendNotificationToProjectMembers(2, $params);
    }
}
