<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Api\Enterprise;

use CrowdinApiClient\Model\Enterprise\ExternalQaCheck;
use CrowdinApiClient\ModelCollection;

class ExternalQaCheckApiTest extends AbstractTestApi
{
    private function qaCheckData(): array
    {
        return [
            'id' => 6,
            'name' => 'Brand voice',
            'description' => null,
            'config' => ['identifier' => 'brand-voice'],
            'createdAt' => '2026-09-01T10:00:00+00:00',
            'updatedAt' => '2026-09-02T10:00:00+00:00',
        ];
    }

    public function testList(): void
    {
        $this->mockRequestGet(
            '/external-qa-checks?projectId=2',
            json_encode([
                'data' => [['data' => $this->qaCheckData()]],
                'pagination' => ['offset' => 0, 'limit' => 25],
            ])
        );

        $qaChecks = $this->crowdin->externalQaCheck->list(['projectId' => 2]);

        $this->assertInstanceOf(ModelCollection::class, $qaChecks);
        $this->assertCount(1, $qaChecks);
        $this->assertInstanceOf(ExternalQaCheck::class, $qaChecks[0]);
    }

    public function testGet(): void
    {
        $this->mockRequestGet('/external-qa-checks/6', json_encode(['data' => $this->qaCheckData()]));

        $qaCheck = $this->crowdin->externalQaCheck->get(6);

        $this->assertInstanceOf(ExternalQaCheck::class, $qaCheck);
        $this->assertEquals('Brand voice', $qaCheck->getName());
    }
}
