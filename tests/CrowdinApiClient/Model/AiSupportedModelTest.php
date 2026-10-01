<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\AiSupportedModel;
use PHPUnit\Framework\TestCase;

class AiSupportedModelTest extends TestCase
{
    public function testLoadData(): void
    {
        $data = [
            'providerId' => 2,
            'providerType' => 'open_ai',
            'providerName' => 'OpenAI',
            'id' => 'gpt-4.1',
            'displayName' => 'GPT-4.1',
            'supportReasoning' => false,
            'intelligence' => 4,
            'speed' => 3,
            'price' => ['input' => 2.0, 'output' => 8.0],
            'modalities' => ['input' => ['text'], 'output' => ['text']],
            'contextWindow' => 128000,
            'maxOutputTokens' => 16384,
            'knowledgeCutoff' => '2024-06',
            'releaseDate' => '2025-04-14',
            'features' => ['streaming' => true, 'structuredOutput' => true, 'functionCalling' => true],
        ];
        $model = new AiSupportedModel($data);

        $this->assertSame(2, $model->getProviderId());
        $this->assertSame('open_ai', $model->getProviderType());
        $this->assertSame('OpenAI', $model->getProviderName());
        $this->assertSame('gpt-4.1', $model->getId());
        $this->assertSame('GPT-4.1', $model->getDisplayName());
        $this->assertFalse($model->getSupportReasoning());
        $this->assertSame(4, $model->getIntelligence());
        $this->assertSame(3, $model->getSpeed());
        $this->assertSame($data['price'], $model->getPrice());
        $this->assertSame($data['modalities'], $model->getModalities());
        $this->assertSame(128000, $model->getContextWindow());
        $this->assertSame(16384, $model->getMaxOutputTokens());
        $this->assertSame('2024-06', $model->getKnowledgeCutoff());
        $this->assertSame('2025-04-14', $model->getReleaseDate());
        $this->assertSame($data['features'], $model->getFeatures());
    }

    public function testLoadDataWithoutOptionalFields(): void
    {
        $model = new AiSupportedModel(['id' => 'gpt-4.1', 'providerType' => 'open_ai']);

        $this->assertNull($model->getProviderId());
        $this->assertNull($model->getKnowledgeCutoff());
        $this->assertNull($model->getReleaseDate());
    }
}
