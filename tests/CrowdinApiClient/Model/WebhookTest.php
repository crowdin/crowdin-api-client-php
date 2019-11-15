<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\Webhook;
use PHPUnit\Framework\TestCase;

class WebhookTest extends TestCase
{
    public $webhook;

    public $data = [
        'id' => 4,
        'projectId' => 2,
        'name' => 'Proofread',
        'url' => 'https://webhook.site/1c20d9b5-6e6a-4522-974d-9da7ea7595c9',
        'events' =>
            [
                0 => 'file.approved',
            ],
        'headers' =>
            [
                0 => 'string',
            ],
        'payload' =>
            [
                0 => 'string',
            ],
        'isActive' => true,
        'requestType' => 'GET',
        'contentType' => 'multipart/form-data',
        'createdAt' => '2019-09-23T09:19:07+00:00',
        'updatedAt' => '2019-09-23T09:19:07+00:00',
    ];

    public function setUp()
    {
        parent::setUp();
        $this->webhook = new Webhook($this->data);
    }

    public function testLoadData()
    {
        $this->assertEquals($this->data['id'], $this->webhook->getId());
        $this->assertEquals($this->data['projectId'], $this->webhook->getProjectId());
        $this->assertEquals($this->data['name'], $this->webhook->getName());
        $this->assertEquals($this->data['url'], $this->webhook->getUrl());
        $this->assertEquals($this->data['events'], $this->webhook->getEvents());
        $this->assertEquals($this->data['headers'], $this->webhook->getHeaders());
        $this->assertEquals($this->data['payload'], $this->webhook->getPayload());
        $this->assertEquals($this->data['isActive'], $this->webhook->isActive());
        $this->assertEquals($this->data['requestType'], $this->webhook->getRequestType());
        $this->assertEquals($this->data['contentType'], $this->webhook->getContentType());
        $this->assertEquals($this->data['createdAt'], $this->webhook->getCreatedAt());
        $this->assertEquals($this->data['updatedAt'], $this->webhook->getUpdatedAt());
    }
}
