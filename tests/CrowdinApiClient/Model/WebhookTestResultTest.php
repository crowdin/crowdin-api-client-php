<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\WebhookTestResult;
use PHPUnit\Framework\TestCase;

class WebhookTestResultTest extends TestCase
{
    public function testLoadData(): void
    {
        $data = [
            'event' => 'file.translated',
            'url' => 'https://example.com/hook',
            'payload' => ['event' => 'file.translated'],
            'status' => 'success',
            'responseStatusCode' => 200,
            'responseBody' => 'OK',
            'error' => null,
        ];

        $result = new WebhookTestResult($data);

        $this->assertSame($data['event'], $result->getEvent());
        $this->assertSame($data['url'], $result->getUrl());
        $this->assertSame($data['payload'], $result->getPayload());
        $this->assertSame($data['status'], $result->getStatus());
        $this->assertSame($data['responseStatusCode'], $result->getResponseStatusCode());
        $this->assertSame($data['responseBody'], $result->getResponseBody());
        $this->assertNull($result->getError());
    }

    public function testLoadDataWithoutOptionalFields(): void
    {
        $result = new WebhookTestResult([
            'event' => 'file.translated',
            'url' => 'https://example.com/hook',
            'payload' => [],
            'status' => 'failed',
            'error' => 'couldNotConnect',
        ]);

        $this->assertNull($result->getResponseStatusCode());
        $this->assertNull($result->getResponseBody());
        $this->assertSame('couldNotConnect', $result->getError());
    }
}
