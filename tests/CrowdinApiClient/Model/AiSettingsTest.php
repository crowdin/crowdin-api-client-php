<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\AiSettings;
use PHPUnit\Framework\TestCase;

class AiSettingsTest extends TestCase
{
    public function testLoadAdditionalFields(): void
    {
        $model = new AiSettings([
            'alignmentActionAiPromptId' => 7,
            'dailyCostLimit' => 1.5,
            'isLimitingActive' => true,
            'monthlyCostLimit' => 1.5,
            'perUserOverrides' => ['key' => 'value'],
            'userDailyCostLimit' => 1.5,
            'userMonthlyCostLimit' => 1.5,
        ]);

        $this->assertSame(7, $model->getAlignmentActionAiPromptId());
        $this->assertSame(1.5, $model->getDailyCostLimit());
        $this->assertSame(true, $model->isLimitingActive());
        $this->assertSame(1.5, $model->getMonthlyCostLimit());
        $this->assertSame(['key' => 'value'], $model->getPerUserOverrides());
        $this->assertSame(1.5, $model->getUserDailyCostLimit());
        $this->assertSame(1.5, $model->getUserMonthlyCostLimit());
    }

    public function testAdditionalFieldsWhenMissing(): void
    {
        $model = new AiSettings([]);

        $this->assertNull($model->getAlignmentActionAiPromptId());
        $this->assertNull($model->getDailyCostLimit());
        $this->assertSame(false, $model->isLimitingActive());
        $this->assertNull($model->getMonthlyCostLimit());
        $this->assertSame([], $model->getPerUserOverrides());
        $this->assertNull($model->getUserDailyCostLimit());
        $this->assertNull($model->getUserMonthlyCostLimit());
    }

    public function testSetAdditionalFields(): void
    {
        $model = new AiSettings([]);
        $model->setAlignmentActionAiPromptId(7);
        $model->setDailyCostLimit(1.5);
        $model->setMonthlyCostLimit(1.5);
        $model->setUserDailyCostLimit(1.5);
        $model->setUserMonthlyCostLimit(1.5);

        $this->assertSame(7, $model->getAlignmentActionAiPromptId());
        $this->assertSame(1.5, $model->getDailyCostLimit());
        $this->assertSame(1.5, $model->getMonthlyCostLimit());
        $this->assertSame(1.5, $model->getUserDailyCostLimit());
        $this->assertSame(1.5, $model->getUserMonthlyCostLimit());
    }
}
