<?php

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\OrganizationWebhook;
use CrowdinApiClient\ModelCollection;

class OrganizationWebhookApiTest extends AbstractTestApi
{
    public function testList()
    {
        $this->mockRequestGet('/webhooks', '{
          "data": [
            {
              "data": {
                "id": 4,
                "name": "Proofread",
                "url": "https://webhook.site/1c20d9b5-6e6a-4522-974d-9da7ea7595c9",
                "events": [
                  "project.created"
                ],
                "headers": {
                  "Authorization": "Bearer ef231f493cafe336f98d486f596282205b3c2a41710f746cd1d37e905df85f696f5858701aa0b700"
                },
                "payload": {
                  "project.created": {
                    "event": "test"
                  }
                },
                "isActive": true,
                "batchingEnabled": true,
                "requestType": "GET",
                "contentType": "application/json",
                "createdAt": "2019-09-23T09:19:07+00:00",
                "updatedAt": "2019-09-23T09:19:07+00:00"
              }
            }
          ],
          "pagination": {
            "offset": 0,
            "limit": 25
          }
        }');

        $webhooks = $this->crowdin->organizationWebhook->list();
        $this->assertInstanceOf(ModelCollection::class, $webhooks);
        $this->assertCount(1, $webhooks);
        $this->assertInstanceOf(OrganizationWebhook::class, $webhooks[0]);
        $this->assertEquals(4, $webhooks[0]->getId());
        $this->assertEquals(true, $webhooks[0]->isBatchingEnabled());
    }

    public function testCreate()
    {
        $params = [
            'name' => 'Proofread',
            'url' => 'https://webhook.site/1c20d9b5-6e6a-4522-974d-9da7ea7595c9',
            'events' =>
                [
                    'project.created',
                ],
            'requestType' => 'POST',
            'isActive' => true,
            'batchingEnabled' => false,
            'contentType' => 'multipart/form-data',
            'headers' =>
                [
                ],
            'payload' =>
                [
                ],
        ];

        $this->mockRequest([
            'path' => '/webhooks',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => '{
              "data": {
                "id": 4,
                "name": "Proofread",
                "url": "https://webhook.site/1c20d9b5-6e6a-4522-974d-9da7ea7595c9",
                "events": [
                  "project.created"
                ],
                "headers": [
                  "string"
                ],
                "payload": [
                  "string"
                ],
                "isActive": true,
                "batchingEnabled": false,
                "requestType": "POST",
                "contentType": "multipart/form-data",
                "createdAt": "2019-09-23T09:19:07+00:00",
                "updatedAt": "2019-09-23T09:19:07+00:00"
              }
            }'
        ]);

        $webhook = $this->crowdin->organizationWebhook->create($params);
        $this->assertInstanceOf(OrganizationWebhook::class, $webhook);
        $this->assertEquals(4, $webhook->getId());
        $this->assertEquals(false, $webhook->isBatchingEnabled());
    }

    public function testGetAndUpdate()
    {
        $this->mockRequestGet('/webhooks/4', '{
              "data": {
                "id": 4,
                "name": "Proofread",
                "url": "https://webhook.site/1c20d9b5-6e6a-4522-974d-9da7ea7595c9",
                "events": [
                  "project.created"
                ],
                "headers": [
                  "string"
                ],
                "payload": [
                  "string"
                ],
                "isActive": true,
                "batchingEnabled": false,
                "requestType": "POST",
                "contentType": "multipart/form-data",
                "createdAt": "2019-09-23T09:19:07+00:00",
                "updatedAt": "2019-09-23T09:19:07+00:00"
              }
            }');
        $webhook = $this->crowdin->organizationWebhook->get(4);
        $this->assertInstanceOf(OrganizationWebhook::class, $webhook);
        $this->assertEquals(4, $webhook->getId());

        $webhook->setName('test');
        $webhook->setBatchingEnabled(true);

        $this->mockRequestPatch('/webhooks/4', '{
              "data": {
                "id": 4,
                "name": "test",
                "url": "https://webhook.site/1c20d9b5-6e6a-4522-974d-9da7ea7595c9",
                "events": [
                  "project.created"
                ],
                "headers": [
                  "string"
                ],
                "payload": [
                  "string"
                ],
                "isActive": true,
                "batchingEnabled": true,
                "requestType": "POST",
                "contentType": "multipart/form-data",
                "createdAt": "2019-09-23T09:19:07+00:00",
                "updatedAt": "2019-09-23T09:19:07+00:00"
              }
            }');

        $webhook = $this->crowdin->organizationWebhook->update($webhook);
        $this->assertInstanceOf(OrganizationWebhook::class, $webhook);
        $this->assertEquals(4, $webhook->getId());
        $this->assertEquals('test', $webhook->getName());
        $this->assertTrue($webhook->isBatchingEnabled());
    }

    public function testDelete()
    {
        $this->mockRequestDelete('/webhooks/4');
        $this->crowdin->organizationWebhook->delete(4);
    }
}
