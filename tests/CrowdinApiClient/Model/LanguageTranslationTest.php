<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\LanguageTranslation;
use PHPUnit\Framework\TestCase;

class LanguageTranslationTest extends TestCase
{
    public function testLoadAdditionalFields(): void
    {
        $model = new LanguageTranslation([
            'createdAt' => 'value',
            'isPreTranslated' => true,
            'matchRate' => 7,
            'matchType' => 'value',
            'provider' => 'value',
            'providerId' => 7,
            'qaIssuesStatus' => 'value',
        ]);

        $this->assertSame('value', $model->getCreatedAt());
        $this->assertSame(true, $model->isPreTranslated());
        $this->assertSame(7, $model->getMatchRate());
        $this->assertSame('value', $model->getMatchType());
        $this->assertSame('value', $model->getProvider());
        $this->assertSame(7, $model->getProviderId());
        $this->assertSame('value', $model->getQaIssuesStatus());
    }

    public function testAdditionalFieldsWhenMissing(): void
    {
        $model = new LanguageTranslation([]);

        $this->assertSame('', $model->getCreatedAt());
        $this->assertSame(false, $model->isPreTranslated());
        $this->assertNull($model->getMatchRate());
        $this->assertNull($model->getMatchType());
        $this->assertNull($model->getProvider());
        $this->assertNull($model->getProviderId());
        $this->assertSame('', $model->getQaIssuesStatus());
    }
}
