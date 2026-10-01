<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\AdvisorInsight;
use PHPUnit\Framework\TestCase;

class AdvisorInsightTest extends TestCase
{
    public function testLoadData(): void
    {
        $data = [
            'id' => 7,
            'inspectorKey' => 'missing-context',
            'category' => 'context',
            'isDismissed' => false,
            'status' => 'done',
            'outcome' => 'flagged',
            'severity' => 'high',
            'refreshPolicy' => 'daily',
            'metrics' => [['key' => 'coverage', 'value' => 42, 'unit' => 'percent']],
            'recommendations' => [['id' => 'add-context', 'primary' => true, 'params' => []]],
            'checkedAt' => '2026-09-23T11:26:54+00:00',
            'lastAiRun' => ['mode' => 'auto', 'promptId' => 3, 'at' => '2026-09-23T11:00:00+00:00'],
            'payload' => ['stringIds' => [1, 2]],
        ];
        $insight = new AdvisorInsight($data);

        $this->assertSame(7, $insight->getId());
        $this->assertSame('missing-context', $insight->getInspectorKey());
        $this->assertSame('context', $insight->getCategory());
        $this->assertFalse($insight->isDismissed());
        $this->assertSame('done', $insight->getStatus());
        $this->assertSame('flagged', $insight->getOutcome());
        $this->assertSame('high', $insight->getSeverity());
        $this->assertSame('daily', $insight->getRefreshPolicy());
        $this->assertSame($data['metrics'], $insight->getMetrics());
        $this->assertSame($data['recommendations'], $insight->getRecommendations());
        $this->assertSame('2026-09-23T11:26:54+00:00', $insight->getCheckedAt());
        $this->assertSame($data['lastAiRun'], $insight->getLastAiRun());
        $this->assertSame($data['payload'], $insight->getPayload());
    }

    public function testLoadDataWithoutOptionalFields(): void
    {
        $insight = new AdvisorInsight(['id' => 7, 'inspectorKey' => 'missing-context', 'status' => 'pending']);

        $this->assertNull($insight->getCategory());
        $this->assertNull($insight->getOutcome());
        $this->assertNull($insight->getSeverity());
        $this->assertNull($insight->getRefreshPolicy());
        $this->assertNull($insight->getCheckedAt());
        $this->assertNull($insight->getLastAiRun());
        $this->assertNull($insight->getPayload());
        $this->assertSame([], $insight->getMetrics());
    }

    public function testSetIsDismissed(): void
    {
        $insight = new AdvisorInsight(['id' => 7, 'isDismissed' => false]);
        $insight->setIsDismissed(true);

        $this->assertTrue($insight->isDismissed());
    }
}
