<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\OrganizationWebhook;
use CrowdinApiClient\Model\Webhook;
use PHPUnit\Framework\TestCase;

class OrganizationWebhookTest extends TestCase
{
    public $webhook;

    public $data = [
        'id' => 4,
        'name' => 'Proofread',
        'url' => 'https://webhook.site/1c20d9b5-6e6a-4522-974d-9da7ea7595c9',
        'events' =>
            [
                'project.created',
            ],
        'headers' =>
            [
                'Accept' => 'application/xml',
            ],
        'payload' =>
            [
                'project.created' => ['string'],
            ],
        'isActive' => true,
        'batchingEnabled' => true,
        'requestType' => 'POST',
        'contentType' => 'application/json',
        'createdAt' => '2019-09-23T09:19:07+00:00',
        'updatedAt' => '2019-09-23T09:19:07+00:00',
    ];

    public function testLoadData(): void
    {
        $this->webhook = new OrganizationWebhook($this->data);
        $this->checkData();
    }

    public function testSetData(): void
    {
        $this->webhook = new Webhook();
        $this->webhook->setName($this->data['name']);
        $this->webhook->setUrl($this->data['url']);
        $this->webhook->setEvents($this->data['events']);
        $this->webhook->setHeaders($this->data['headers']);
        $this->webhook->setPayload($this->data['payload']);
        $this->webhook->setIsActive($this->data['isActive']);
        $this->webhook->setBatchingEnabled($this->data['batchingEnabled']);
        $this->webhook->setRequestType($this->data['requestType']);
        $this->webhook->setContentType($this->data['contentType']);

        $this->assertEquals($this->data['name'], $this->webhook->getName());
        $this->assertEquals($this->data['url'], $this->webhook->getUrl());
        $this->assertEquals($this->data['events'], $this->webhook->getEvents());
        $this->assertEquals($this->data['headers'], $this->webhook->getHeaders());
        $this->assertEquals($this->data['payload'], $this->webhook->getPayload());
        $this->assertEquals($this->data['isActive'], $this->webhook->isActive());
        $this->assertEquals($this->data['batchingEnabled'], $this->webhook->isBatchingEnabled());
        $this->assertEquals($this->data['requestType'], $this->webhook->getRequestType());
        $this->assertEquals($this->data['contentType'], $this->webhook->getContentType());
    }

    public function checkData(): void
    {
        $this->assertEquals($this->data['id'], $this->webhook->getId());
        $this->assertEquals($this->data['name'], $this->webhook->getName());
        $this->assertEquals($this->data['url'], $this->webhook->getUrl());
        $this->assertEquals($this->data['events'], $this->webhook->getEvents());
        $this->assertEquals($this->data['headers'], $this->webhook->getHeaders());
        $this->assertEquals($this->data['payload'], $this->webhook->getPayload());
        $this->assertEquals($this->data['isActive'], $this->webhook->isActive());
        $this->assertEquals($this->data['batchingEnabled'], $this->webhook->isBatchingEnabled());
        $this->assertEquals($this->data['requestType'], $this->webhook->getRequestType());
        $this->assertEquals($this->data['contentType'], $this->webhook->getContentType());
        $this->assertEquals($this->data['createdAt'], $this->webhook->getCreatedAt());
        $this->assertEquals($this->data['updatedAt'], $this->webhook->getUpdatedAt());
    }
}
