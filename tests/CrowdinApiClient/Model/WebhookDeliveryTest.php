<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\WebhookDelivery;
use PHPUnit\Framework\TestCase;

class WebhookDeliveryTest extends TestCase
{
    public function testLoadData(): void
    {
        $data = [
            'id' => 101,
            'webhookId' => 4,
            'event' => 'file.translated',
            'url' => 'https://example.com/hook',
            'status' => 'success',
            'responseStatusCode' => 200,
            'responseBody' => 'OK',
            'fileId' => 12,
            'languageId' => 'uk',
            'createdAt' => '2026-10-20T10:00:00+00:00',
            'requestType' => 'POST',
            'contentType' => 'application/json',
            'headers' => ['Authorization' => '***'],
            'payload' => ['event' => 'file.translated'],
        ];

        $delivery = new WebhookDelivery($data);

        $this->assertSame($data['id'], $delivery->getId());
        $this->assertSame($data['webhookId'], $delivery->getWebhookId());
        $this->assertSame($data['event'], $delivery->getEvent());
        $this->assertSame($data['url'], $delivery->getUrl());
        $this->assertSame($data['status'], $delivery->getStatus());
        $this->assertSame($data['responseStatusCode'], $delivery->getResponseStatusCode());
        $this->assertSame($data['responseBody'], $delivery->getResponseBody());
        $this->assertSame($data['fileId'], $delivery->getFileId());
        $this->assertSame($data['languageId'], $delivery->getLanguageId());
        $this->assertSame($data['createdAt'], $delivery->getCreatedAt());
        $this->assertSame($data['requestType'], $delivery->getRequestType());
        $this->assertSame($data['contentType'], $delivery->getContentType());
        $this->assertSame($data['headers'], $delivery->getHeaders());
        $this->assertSame($data['payload'], $delivery->getPayload());
    }

    public function testLoadDataWithoutOptionalFields(): void
    {
        $delivery = new WebhookDelivery([
            'id' => 101,
            'webhookId' => 4,
            'event' => 'project.built',
            'url' => 'https://example.com/hook',
            'status' => 'failed',
            'responseStatusCode' => null,
            'responseBody' => null,
            'fileId' => null,
            'languageId' => null,
            'createdAt' => '2026-10-20T10:00:00+00:00',
        ]);

        $this->assertNull($delivery->getResponseStatusCode());
        $this->assertNull($delivery->getResponseBody());
        $this->assertNull($delivery->getFileId());
        $this->assertNull($delivery->getLanguageId());
        $this->assertNull($delivery->getRequestType());
        $this->assertNull($delivery->getContentType());
        $this->assertNull($delivery->getHeaders());
        $this->assertNull($delivery->getPayload());
    }
}
