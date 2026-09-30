<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\AiProviderModel;
use PHPUnit\Framework\TestCase;

class AiProviderModelTest extends TestCase
{
    public function testLoadData(): void
    {
        $model = new AiProviderModel([
            'id' => 'gpt-4.1',
            'provider' => 'open_ai',
            'providerName' => 'OpenAI',
            'providerId' => 2,
            'contextWindow' => 128000,
            'maxOutputTokens' => 16384,
            'supportsStreaming' => true,
            'supportsFunctionCalling' => true,
            'supportsJsonMode' => false,
            'supportsJsonSchema' => true,
            'supportsVision' => false,
            'isCompatibleWithAiLimit' => true,
        ]);

        $this->assertSame('gpt-4.1', $model->getId());
        $this->assertSame('open_ai', $model->getProvider());
        $this->assertSame('OpenAI', $model->getProviderName());
        $this->assertSame(2, $model->getProviderId());
        $this->assertSame(128000, $model->getContextWindow());
        $this->assertSame(16384, $model->getMaxOutputTokens());
        $this->assertTrue($model->getSupportsStreaming());
        $this->assertTrue($model->getSupportsFunctionCalling());
        $this->assertFalse($model->getSupportsJsonMode());
        $this->assertTrue($model->getSupportsJsonSchema());
        $this->assertFalse($model->getSupportsVision());
        $this->assertTrue($model->getIsCompatibleWithAiLimit());
    }

    public function testLoadDataWithoutOptionalFields(): void
    {
        $model = new AiProviderModel(['id' => 'gpt-4.1']);

        $this->assertNull($model->getProvider());
        $this->assertNull($model->getProviderId());
        $this->assertNull($model->getContextWindow());
        $this->assertNull($model->getMaxOutputTokens());
        $this->assertNull($model->getSupportsStreaming());
        $this->assertNull($model->getSupportsVision());
        $this->assertFalse($model->getIsCompatibleWithAiLimit());
    }
}
