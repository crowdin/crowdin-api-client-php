<?php

namespace CrowdinApiClient\Tests\Api\Enterprise;

class NotificationApiTest extends AbstractTestApi
{

    public function testSendNotificationToOrganizationMembers()
    {
        $params = [
            'message' => 'New notification message',
            'userIds' => [1]
        ];

        $this->mockRequest([
            'method' => 'post',
            'uri' => 'https://organization_domain.crowdin.com/api/v2/notify',
            'body' => $params,
            'response' => null
        ]);

        $this->crowdin->notification->sendNotificationToOrganizationMembers($params);
    }
}
