<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\AiRequestLog;
use PHPUnit\Framework\TestCase;

class AiRequestLogTest extends TestCase
{
    public function testLoadData(): void
    {
        $data = [
            'id' => 12345,
            'requestId' => '9d3b1c4e-2f3a-4b5c-8d6e-7f8a9b0c1d2e',
            'createdAt' => '2026-01-01T10:00:00+00:00',
            'status' => 'success',
            'httpStatus' => 200,
            'model' => 'gpt-5.6-sol',
            'sourceAction' => 'ai_gateway',
            'promptAction' => 'pre_translate',
            'systemCredentials' => true,
            'isAutoTriggered' => false,
            'durationMs' => 842,
            'inputTokens' => 512,
            'outputTokens' => 128,
            'totalCost' => 0.012345,
            'userId' => 42,
            'projectId' => 8,
            'promptId' => 5,
            'aiProviderId' => 3,
            'tokenName' => 'CI token',
            'oauthClientId' => 'gpbccUFxAKZDrLm5Nq8t',
            'oauthClientName' => 'AI Pipeline',
            'ip' => '203.0.113.42',
            'userAgent' => 'Mozilla/5.0',
            'error' => null,
        ];

        $requestLog = new AiRequestLog($data);

        $this->assertSame(12345, $requestLog->getId());
        $this->assertSame($data['requestId'], $requestLog->getRequestId());
        $this->assertSame($data['createdAt'], $requestLog->getCreatedAt());
        $this->assertSame($data['status'], $requestLog->getStatus());
        $this->assertSame($data['httpStatus'], $requestLog->getHttpStatus());
        $this->assertSame($data['model'], $requestLog->getModel());
        $this->assertSame($data['sourceAction'], $requestLog->getSourceAction());
        $this->assertSame($data['promptAction'], $requestLog->getPromptAction());
        $this->assertTrue($requestLog->isSystemCredentials());
        $this->assertFalse($requestLog->isAutoTriggered());
        $this->assertSame($data['durationMs'], $requestLog->getDurationMs());
        $this->assertSame($data['inputTokens'], $requestLog->getInputTokens());
        $this->assertSame($data['outputTokens'], $requestLog->getOutputTokens());
        $this->assertSame($data['totalCost'], $requestLog->getTotalCost());
        $this->assertSame($data['userId'], $requestLog->getUserId());
        $this->assertSame($data['projectId'], $requestLog->getProjectId());
        $this->assertSame($data['promptId'], $requestLog->getPromptId());
        $this->assertSame($data['aiProviderId'], $requestLog->getAiProviderId());
        $this->assertSame($data['tokenName'], $requestLog->getTokenName());
        $this->assertSame($data['oauthClientId'], $requestLog->getOauthClientId());
        $this->assertSame($data['oauthClientName'], $requestLog->getOauthClientName());
        $this->assertSame($data['ip'], $requestLog->getIp());
        $this->assertSame($data['userAgent'], $requestLog->getUserAgent());
        $this->assertNull($requestLog->getError());
    }

    public function testLoadDataWithoutOptionalFields(): void
    {
        $requestLog = new AiRequestLog([
            'id' => 12345,
            'requestId' => '9d3b1c4e-2f3a-4b5c-8d6e-7f8a9b0c1d2e',
            'createdAt' => '2026-01-01T10:00:00+00:00',
            'status' => 'pending',
            'model' => 'gpt-5.6-sol',
            'sourceAction' => 'ai_gateway',
            'systemCredentials' => false,
            'isAutoTriggered' => true,
            'aiProviderId' => 3,
        ]);

        $this->assertNull($requestLog->getHttpStatus());
        $this->assertNull($requestLog->getPromptAction());
        $this->assertNull($requestLog->getDurationMs());
        $this->assertNull($requestLog->getInputTokens());
        $this->assertNull($requestLog->getOutputTokens());
        $this->assertNull($requestLog->getTotalCost());
        $this->assertNull($requestLog->getUserId());
        $this->assertNull($requestLog->getProjectId());
        $this->assertNull($requestLog->getPromptId());
        $this->assertNull($requestLog->getTokenName());
        $this->assertNull($requestLog->getOauthClientId());
        $this->assertNull($requestLog->getOauthClientName());
        $this->assertNull($requestLog->getIp());
        $this->assertNull($requestLog->getUserAgent());
        $this->assertNull($requestLog->getError());
    }
}
