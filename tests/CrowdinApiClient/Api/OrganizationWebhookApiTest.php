<?php

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\OrganizationWebhook;
use CrowdinApiClient\Model\WebhookDelivery;
use CrowdinApiClient\Model\WebhookTestResult;
use CrowdinApiClient\ModelCollection;

class OrganizationWebhookApiTest extends AbstractTestApi
{
    public function testList()
    {
        $this->mockRequestGet(
            '/webhooks',
            json_encode([
                'data' => [
                    [
                        'data' => [
                            'id' => 4,
                            'name' => 'Proofread',
                            'url' => 'https://webhook.site/1c20d9b5-6e6a-4522-974d-9da7ea7595c9',
                            'events' => [
                                'project.created',
                            ],
                            'headers' => [
                                'Authorization' => 'Bearer ef231f493cafe336f98d486f596282205b3c2a41710f746cd1d37e905df85f696f5858701aa0b700',
                            ],
                            'payload' => [
                                'project.created' => [
                                    'event' => 'test',
                                ],
                            ],
                            'isActive' => true,
                            'batchingEnabled' => true,
                            'requestType' => 'GET',
                            'contentType' => 'application/json',
                            'createdAt' => '2019-09-23T09:19:07+00:00',
                            'updatedAt' => '2019-09-23T09:19:07+00:00',
                        ],
                    ],
                ],
                'pagination' => [
                    'offset' => 0,
                    'limit' => 25,
                ],
            ])
        );

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
            'events' => [
                'project.created',
            ],
            'requestType' => 'POST',
            'isActive' => true,
            'batchingEnabled' => false,
            'contentType' => 'multipart/form-data',
            'headers' => [],
            'payload' => [],
        ];

        $this->mockRequest([
            'path' => '/webhooks',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => json_encode([
                'data' => [
                    'id' => 4,
                    'name' => 'Proofread',
                    'url' => 'https://webhook.site/1c20d9b5-6e6a-4522-974d-9da7ea7595c9',
                    'events' => [
                        'project.created',
                    ],
                    'headers' => [
                        'string',
                    ],
                    'payload' => [
                        'string',
                    ],
                    'isActive' => true,
                    'batchingEnabled' => false,
                    'requestType' => 'POST',
                    'contentType' => 'multipart/form-data',
                    'createdAt' => '2019-09-23T09:19:07+00:00',
                    'updatedAt' => '2019-09-23T09:19:07+00:00',
                ],
            ]),
        ]);

        $webhook = $this->crowdin->organizationWebhook->create($params);

        $this->assertInstanceOf(OrganizationWebhook::class, $webhook);
        $this->assertEquals(4, $webhook->getId());
        $this->assertEquals(false, $webhook->isBatchingEnabled());
    }

    public function testGetAndUpdate()
    {
        $this->mockRequestGet(
            '/webhooks/4',
            json_encode([
                'data' => [
                    'id' => 4,
                    'name' => 'Proofread',
                    'url' => 'https://webhook.site/1c20d9b5-6e6a-4522-974d-9da7ea7595c9',
                    'events' => [
                        'project.created',
                    ],
                    'headers' => [
                        'string',
                    ],
                    'payload' => [
                        'string',
                    ],
                    'isActive' => true,
                    'batchingEnabled' => false,
                    'requestType' => 'POST',
                    'contentType' => 'multipart/form-data',
                    'createdAt' => '2019-09-23T09:19:07+00:00',
                    'updatedAt' => '2019-09-23T09:19:07+00:00',
                ],
            ])
        );

        $webhook = $this->crowdin->organizationWebhook->get(4);

        $this->assertInstanceOf(OrganizationWebhook::class, $webhook);
        $this->assertEquals(4, $webhook->getId());

        $webhook->setName('test');
        $webhook->setBatchingEnabled(true);

        $this->mockRequestPatch(
            '/webhooks/4',
            json_encode([
                'data' => [
                    'id' => 4,
                    'name' => 'test',
                    'url' => 'https://webhook.site/1c20d9b5-6e6a-4522-974d-9da7ea7595c9',
                    'events' => [
                        'project.created',
                    ],
                    'headers' => [
                        'string',
                    ],
                    'payload' => [
                        'string',
                    ],
                    'isActive' => true,
                    'batchingEnabled' => true,
                    'requestType' => 'POST',
                    'contentType' => 'multipart/form-data',
                    'createdAt' => '2019-09-23T09:19:07+00:00',
                    'updatedAt' => '2019-09-23T09:19:07+00:00',
                ],
            ])
        );

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

    public function testListAllDeliveries(): void
    {
        $this->mockRequest([
            'path' => '/webhooks/deliveries?status=failed&events=file.translated',
            'method' => 'get',
            'response' => json_encode([
                'data' => [
                    [
                        'data' => $this->deliveryData(),
                    ],
                ],
                'pagination' => ['offset' => 0, 'limit' => 25],
            ]),
        ]);

        $deliveries = $this->crowdin->organizationWebhook->listAllDeliveries(
            ['status' => 'failed', 'events' => 'file.translated']
        );

        $this->assertInstanceOf(ModelCollection::class, $deliveries);
        $this->assertCount(1, $deliveries);
        $this->assertInstanceOf(WebhookDelivery::class, $deliveries[0]);
        $this->assertEquals(101, $deliveries[0]->getId());
    }

    public function testListDeliveries(): void
    {
        $this->mockRequest([
            'path' => '/webhooks/4/deliveries',
            'method' => 'get',
            'response' => json_encode([
                'data' => [
                    [
                        'data' => $this->deliveryData(),
                    ],
                ],
                'pagination' => ['offset' => 0, 'limit' => 25],
            ]),
        ]);

        $deliveries = $this->crowdin->organizationWebhook->listDeliveries(4);

        $this->assertInstanceOf(ModelCollection::class, $deliveries);
        $this->assertCount(1, $deliveries);
        $this->assertInstanceOf(WebhookDelivery::class, $deliveries[0]);
        $this->assertEquals(4, $deliveries[0]->getWebhookId());
    }

    public function testGetDelivery(): void
    {
        $data = $this->deliveryData() + [
                'requestType' => 'POST',
                'contentType' => 'application/json',
                'headers' => ['Authorization' => '***'],
                'payload' => ['event' => 'file.translated'],
            ];

        $this->mockRequest([
            'path' => '/webhooks/4/deliveries/101',
            'method' => 'get',
            'response' => json_encode(['data' => $data]),
        ]);

        $delivery = $this->crowdin->organizationWebhook->getDelivery(4, 101);

        $this->assertInstanceOf(WebhookDelivery::class, $delivery);
        $this->assertEquals('POST', $delivery->getRequestType());
        $this->assertEquals(['event' => 'file.translated'], $delivery->getPayload());
    }

    public function testResendDelivery(): void
    {
        $this->mockRequest([
            'path' => '/webhooks/4/deliveries/101/resend',
            'method' => 'post',
            'body' => json_encode([]),
            'response' => json_encode(['data' => ['id' => 102] + $this->deliveryData()]),
        ]);

        $delivery = $this->crowdin->organizationWebhook->resendDelivery(4, 101);

        $this->assertInstanceOf(WebhookDelivery::class, $delivery);
        $this->assertEquals(102, $delivery->getId());
    }

    public function testTest(): void
    {
        $data = ['event' => 'file.translated'];

        $this->mockRequest([
            'path' => '/webhooks/4/tests',
            'method' => 'post',
            'body' => json_encode($data),
            'response' => json_encode([
                'data' => [
                    'event' => 'file.translated',
                    'url' => 'https://example.com/hook',
                    'payload' => ['event' => 'file.translated'],
                    'status' => 'failed',
                    'responseStatusCode' => null,
                    'responseBody' => null,
                    'error' => 'timeout',
                ],
            ]),
        ]);

        $result = $this->crowdin->organizationWebhook->test(4, $data);

        $this->assertInstanceOf(WebhookTestResult::class, $result);
        $this->assertEquals('failed', $result->getStatus());
        $this->assertEquals('timeout', $result->getError());
    }

    public function testTestWithoutEvent(): void
    {
        $this->mockRequest([
            'path' => '/webhooks/4/tests',
            'method' => 'post',
            'body' => json_encode([]),
            'response' => json_encode([
                'data' => [
                    'event' => 'file.added',
                    'status' => 'success',
                    'responseStatusCode' => 200,
                ],
            ]),
        ]);

        $this->assertInstanceOf(WebhookTestResult::class, $this->crowdin->organizationWebhook->test(4));
    }

    private function deliveryData(): array
    {
        return [
            'id' => 101,
            'webhookId' => 4,
            'event' => 'file.translated',
            'url' => 'https://example.com/hook',
            'status' => 'failed',
            'responseStatusCode' => 500,
            'responseBody' => 'Internal Server Error',
            'fileId' => 12,
            'languageId' => 'uk',
            'createdAt' => '2026-10-20T10:00:00+00:00',
        ];
    }
}
