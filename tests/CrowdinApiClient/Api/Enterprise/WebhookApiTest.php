<?php

namespace CrowdinApiClient\Tests\Api\Enterprise;

use CrowdinApiClient\Model\Enterprise\Webhook;
use CrowdinApiClient\ModelCollection;

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
        $this->assertInstanceOf(ModelCollection::class, $webhooks);
        $this->assertCount(1, $webhooks);
        $this->assertInstanceOf(Webhook::class, $webhooks[0]);
        $this->assertEquals(4, $webhooks[0]->getId());
    }

    public function testCreate()
    {
        $params = [
            'name' => 'Proofread',
            'url' => 'https://webhook.site/1c20d9b5-6e6a-4522-974d-9da7ea7595c9',
            'events' =>
                [
                    0 => 'file.approved',
                ],
            'requestType' => 'POST',
            'isActive' => true,
            'contentType' => 'multipart/form-data',
            'headers' =>
                [
                ],
            'payload' =>
                [
                ],
        ];

        $this->mockRequest([
            'path' => '/projects/2/webhooks',
            'method' => 'post',
            'body' => $params,
            'response' => '{
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
            }'
        ]);

        $webhook = $this->crowdin->webhook->create(2, $params);
        $this->assertInstanceOf(Webhook::class, $webhook);
        $this->assertEquals(4, $webhook->getId());
    }

    public function testGetAndUpdate()
    {
        $this->mockRequestGet('/projects/2/webhooks/4', '{
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
            }');

        $webhook = $this->crowdin->webhook->get(2, 4);
        $this->assertInstanceOf(Webhook::class, $webhook);
        $this->assertEquals(4, $webhook->getId());

        $webhook->setName('test edit');
        $this->mockRequestPath('/projects/2/webhooks/4', '{
              "data": {
                "id": 4,
                "projectId": 2,
                "name": "test edit",
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
            }');

        $webhook = $this->crowdin->webhook->update($webhook);
        $this->assertInstanceOf(Webhook::class, $webhook);
        $this->assertEquals(4, $webhook->getId());
        $this->assertEquals('test edit', $webhook->getName());
    }

    public function testDelete()
    {
        $this->mockRequestDelete('/projects/2/webhooks/4');
        $this->crowdin->webhook->delete(2, 4);
    }
}
