<?php

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\Webhook;
use CrowdinApiClient\Model\WebhookDelivery;
use CrowdinApiClient\Model\WebhookTestResult;
use CrowdinApiClient\ModelCollection;

class WebhookApiTest extends AbstractTestApi
{
    public function testList()
    {
        $this->mockRequest([
            'path' => '/projects/2/webhooks',
            'method' => 'get',
            'response' => json_encode([
                'data' => [
                    [
                        'data' => [
                            'id' => 4,
                            'projectId' => 2,
                            'name' => 'Proofread',
                            'url' => 'https://webhook.site/1c20d9b5-6e6a-4522-974d-9da7ea7595c9',
                            'events' => [
                                'file.approved',
                            ],
                            'headers' => [
                                'string',
                            ],
                            'payload' => [
                                'string',
                            ],
                            'isActive' => true,
                            'batchingEnabled' => true,
                            'requestType' => 'GET',
                            'contentType' => 'multipart/form-data',
                            'createdAt' => '2019-09-23T09:19:07+00:00',
                            'updatedAt' => '2019-09-23T09:19:07+00:00',
                        ],
                    ],
                ],
                'pagination' => [
                    [
                        'offset' => 0,
                        'limit' => 0,
                    ],
                ],
            ]),
        ]);

        $webhooks = $this->crowdin->webhook->list(2);

        $this->assertInstanceOf(ModelCollection::class, $webhooks);
        $this->assertCount(1, $webhooks);
        $this->assertInstanceOf(Webhook::class, $webhooks[0]);
        $this->assertEquals(4, $webhooks[0]->getId());
        $this->assertEquals(true, $webhooks[0]->isBatchingEnabled());
    }

    public function testCreate()
    {
        $params = [
            'name' => 'Proofread',
            'url' => 'https://webhook.site/1c20d9b5-6e6a-4522-974d-9da7ea7595c9',
            'events' => [
                'file.approved',
            ],
            'requestType' => 'POST',
            'isActive' => true,
            'batchingEnabled' => false,
            'contentType' => 'multipart/form-data',
            'headers' => [],
            'payload' => [],
        ];

        $this->mockRequest([
            'path' => '/projects/2/webhooks',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => json_encode([
                'data' => [
                    'id' => 4,
                    'projectId' => 2,
                    'name' => 'Proofread',
                    'url' => 'https://webhook.site/1c20d9b5-6e6a-4522-974d-9da7ea7595c9',
                    'events' => [
                        'file.approved',
                    ],
                    'headers' => [
                        'string',
                    ],
                    'payload' => [
                        'string',
                    ],
                    'isActive' => true,
                    'batchingEnabled' => false,
                    'requestType' => 'GET',
                    'contentType' => 'multipart/form-data',
                    'createdAt' => '2019-09-23T09:19:07+00:00',
                    'updatedAt' => '2019-09-23T09:19:07+00:00',
                ],
            ]),
        ]);

        $webhook = $this->crowdin->webhook->create(2, $params);

        $this->assertInstanceOf(Webhook::class, $webhook);
        $this->assertEquals(4, $webhook->getId());
        $this->assertEquals(false, $webhook->isBatchingEnabled());
    }

    public function testGetAndUpdate()
    {
        $this->mockRequestGet(
            '/projects/2/webhooks/4',
            json_encode([
                'data' => [
                    'id' => 4,
                    'projectId' => 2,
                    'name' => 'Proofread',
                    'url' => 'https://webhook.site/1c20d9b5-6e6a-4522-974d-9da7ea7595c9',
                    'events' => [
                        'file.approved',
                    ],
                    'headers' => [
                        'string',
                    ],
                    'payload' => [
                        'string',
                    ],
                    'isActive' => true,
                    'batchingEnabled' => true,
                    'requestType' => 'GET',
                    'contentType' => 'multipart/form-data',
                    'createdAt' => '2019-09-23T09:19:07+00:00',
                    'updatedAt' => '2019-09-23T09:19:07+00:00',
                ],
            ])
        );

        $webhook = $this->crowdin->webhook->get(2, 4);

        $this->assertInstanceOf(Webhook::class, $webhook);
        $this->assertEquals(4, $webhook->getId());

        $webhook->setName('test edit');
        $webhook->setBatchingEnabled(false);

        $this->mockRequestPatch(
            '/projects/2/webhooks/4',
            json_encode([
                'data' => [
                    'id' => 4,
                    'projectId' => 2,
                    'name' => 'test edit',
                    'url' => 'https://webhook.site/1c20d9b5-6e6a-4522-974d-9da7ea7595c9',
                    'events' => [
                        'file.approved',
                    ],
                    'headers' => [
                        'string',
                    ],
                    'payload' => [
                        'string',
                    ],
                    'isActive' => true,
                    'batchingEnabled' => false,
                    'requestType' => 'GET',
                    'contentType' => 'multipart/form-data',
                    'createdAt' => '2019-09-23T09:19:07+00:00',
                    'updatedAt' => '2019-09-23T09:19:07+00:00',
                ],
            ])
        );

        $webhook = $this->crowdin->webhook->update($webhook);

        $this->assertInstanceOf(Webhook::class, $webhook);
        $this->assertEquals(4, $webhook->getId());
        $this->assertEquals('test edit', $webhook->getName());
        $this->assertEquals(false, $webhook->isBatchingEnabled());
    }

    public function testDelete()
    {
        $this->mockRequestDelete('/projects/2/webhooks/4');
        $this->crowdin->webhook->delete(2, 4);
    }

    public function testListAllDeliveries(): void
    {
        $this->mockRequest([
            'path' => '/projects/2/webhooks/deliveries?status=failed&events=file.translated',
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

        $deliveries = $this->crowdin->webhook->listAllDeliveries(
            2,
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
            'path' => '/projects/2/webhooks/4/deliveries',
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

        $deliveries = $this->crowdin->webhook->listDeliveries(2, 4);

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
            'path' => '/projects/2/webhooks/4/deliveries/101',
            'method' => 'get',
            'response' => json_encode(['data' => $data]),
        ]);

        $delivery = $this->crowdin->webhook->getDelivery(2, 4, 101);

        $this->assertInstanceOf(WebhookDelivery::class, $delivery);
        $this->assertEquals('POST', $delivery->getRequestType());
        $this->assertEquals(['event' => 'file.translated'], $delivery->getPayload());
    }

    public function testResendDelivery(): void
    {
        $this->mockRequest([
            'path' => '/projects/2/webhooks/4/deliveries/101/resend',
            'method' => 'post',
            'body' => json_encode([]),
            'response' => json_encode(['data' => ['id' => 102] + $this->deliveryData()]),
        ]);

        $delivery = $this->crowdin->webhook->resendDelivery(2, 4, 101);

        $this->assertInstanceOf(WebhookDelivery::class, $delivery);
        $this->assertEquals(102, $delivery->getId());
    }

    public function testTest(): void
    {
        $data = ['event' => 'file.translated'];

        $this->mockRequest([
            'path' => '/projects/2/webhooks/4/tests',
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

        $result = $this->crowdin->webhook->test(2, 4, $data);

        $this->assertInstanceOf(WebhookTestResult::class, $result);
        $this->assertEquals('failed', $result->getStatus());
        $this->assertEquals('timeout', $result->getError());
    }

    public function testTestWithoutEvent(): void
    {
        $this->mockRequest([
            'path' => '/projects/2/webhooks/4/tests',
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

        $this->assertInstanceOf(WebhookTestResult::class, $this->crowdin->webhook->test(2, 4));
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
