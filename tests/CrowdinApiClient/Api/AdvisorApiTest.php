<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\AdvisorCheck;
use CrowdinApiClient\Model\AdvisorInsight;
use CrowdinApiClient\ModelCollection;

class AdvisorApiTest extends AbstractTestApi
{
    private function checkResponse(): string
    {
        return json_encode([
            'data' => [
                'identifier' => '50fb3506-4127-4ba8-8296-f97dc7e3e0c3',
                'status' => 'created',
                'progress' => 0,
                'attributes' => [
                    'category' => 'context',
                    'inspectors' => [],
                ],
                'createdAt' => '2026-09-23T11:26:54+00:00',
                'updatedAt' => '2026-09-23T11:26:54+00:00',
                'startedAt' => null,
                'finishedAt' => null,
            ],
        ]);
    }

    private function insightData(): array
    {
        return [
            'id' => 7,
            'inspectorKey' => 'missing-context',
            'category' => 'context',
            'isDismissed' => false,
            'status' => 'done',
            'outcome' => 'flagged',
            'severity' => 'high',
            'refreshPolicy' => 'daily',
            'metrics' => [
                [
                    'key' => 'coverage',
                    'value' => 42,
                    'unit' => 'percent',
                    'threshold' => 80,
                    'tone' => 'danger',
                    'source' => 'deterministic',
                    'checkedAt' => null,
                ],
            ],
            'recommendations' => [],
            'checkedAt' => '2026-09-23T11:26:54+00:00',
            'lastAiRun' => null,
            'payload' => null,
        ];
    }

    public function testCreateCheck(): void
    {
        $data = ['category' => 'context'];

        $this->mockRequest([
            'path' => '/projects/2/advisors/checks',
            'method' => 'post',
            'body' => json_encode($data),
            'response' => $this->checkResponse(),
        ]);

        $check = $this->crowdin->advisor->createCheck(2, $data);

        $this->assertInstanceOf(AdvisorCheck::class, $check);
        $this->assertEquals('50fb3506-4127-4ba8-8296-f97dc7e3e0c3', $check->getIdentifier());
    }

    public function testCreateCheckForAllInspectors(): void
    {
        $this->mockRequest([
            'path' => '/projects/2/advisors/checks',
            'method' => 'post',
            'body' => json_encode([]),
            'response' => $this->checkResponse(),
        ]);

        $this->assertInstanceOf(AdvisorCheck::class, $this->crowdin->advisor->createCheck(2));
    }

    public function testGetCheck(): void
    {
        $this->mockRequestGet(
            '/projects/2/advisors/checks/50fb3506-4127-4ba8-8296-f97dc7e3e0c3',
            $this->checkResponse()
        );

        $check = $this->crowdin->advisor->getCheck(2, '50fb3506-4127-4ba8-8296-f97dc7e3e0c3');

        $this->assertInstanceOf(AdvisorCheck::class, $check);
        $this->assertEquals('created', $check->getStatus());
        $this->assertEquals('context', $check->getAttributes()['category']);
    }

    public function testListInsights(): void
    {
        $this->mockRequestGet(
            '/projects/2/advisors/insights?isDismissed=0&outcome=flagged',
            json_encode([
                'data' => [['data' => $this->insightData()]],
                'pagination' => ['offset' => 0, 'limit' => 25, 'total' => 1],
            ])
        );

        $insights = $this->crowdin->advisor->listInsights(2, ['isDismissed' => false, 'outcome' => 'flagged']);

        $this->assertInstanceOf(ModelCollection::class, $insights);
        $this->assertCount(1, $insights);
        $this->assertInstanceOf(AdvisorInsight::class, $insights[0]);
        $this->assertEquals('missing-context', $insights[0]->getInspectorKey());
    }

    public function testUpdateInsight(): void
    {
        $insight = new AdvisorInsight($this->insightData());
        $insight->setIsDismissed(true);

        $this->mockRequest([
            'path' => '/projects/2/advisors/insights/7',
            'method' => 'patch',
            'body' => json_encode([['op' => 'replace', 'path' => '/isDismissed', 'value' => true]]),
            'response' => json_encode(['data' => array_merge($this->insightData(), ['isDismissed' => true])]),
        ]);

        $updated = $this->crowdin->advisor->updateInsight(2, $insight);

        $this->assertInstanceOf(AdvisorInsight::class, $updated);
        $this->assertTrue($updated->isDismissed());
    }

    public function testPutApplicationInsight(): void
    {
        $data = [
            'outcome' => 'flagged',
            'checkedAt' => '2026-09-23T11:26:54+00:00',
            'metrics' => [['key' => 'coverage', 'value' => 42, 'unit' => 'percent']],
        ];

        $this->mockRequest([
            'path' => '/projects/2/applications/my-app/modules/my-inspector/advisors/insights',
            'method' => 'put',
            'body' => json_encode($data),
            'response' => '',
        ]);

        $this->assertNull($this->crowdin->advisor->putApplicationInsight(2, 'my-app', 'my-inspector', $data));
    }
}
