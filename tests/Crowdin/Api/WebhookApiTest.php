<?php

namespace Crowdin\Tests\Api;

use Crowdin\Model\Webhook;

class WebhookApiTest extends AbstractTestApi
{
    public function testList()
    {
        $this->mockRequest([
            'path' => '/projects/2/webhooks',
            'method' => 'get',
            'response' => '{
              "data": [
                {
                  "data": {
                    "id": 4,
                    "projectId": 2,
                    "name": "Proofread",
                    "url": "https://webhook.site/1c20d9b5-6e6a-4522-974d-9da7ea7595c9",
                    "events": [
                      "file.approved"
                    ],
                    "headers": [
                      "string"
                    ],
                    "payload": [
                      "string"
                    ],
                    "isActive": true,
                    "requestType": "GET",
                    "contentType": "multipart/form-data",
                    "createdAt": "2019-09-23T09:19:07+00:00",
                    "updatedAt": "2019-09-23T09:19:07+00:00"
                  }
                }
              ],
              "pagination": [
                {
                  "offset": 0,
                  "limit": 0
                }
              ]
            }'
        ]);

        $webhooks = $this->crowdin->webhook->list(2);
        $this->assertIsArray($webhooks);
        $this->assertCount(1, $webhooks);
        $this->assertInstanceOf(Webhook::class, $webhooks[0]);
        $this->assertEquals(4, $webhooks[0]->getId());
    }
}
