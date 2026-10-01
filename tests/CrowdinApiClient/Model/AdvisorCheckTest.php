<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\AdvisorCheck;
use PHPUnit\Framework\TestCase;

class AdvisorCheckTest extends TestCase
{
    public function testLoadData(): void
    {
        $check = new AdvisorCheck([
            'identifier' => '50fb3506-4127-4ba8-8296-f97dc7e3e0c3',
            'status' => 'finished',
            'progress' => 100,
            'attributes' => ['inspectors' => [['key' => 'missing-context']]],
            'createdAt' => '2026-09-23T11:26:54+00:00',
            'updatedAt' => '2026-09-23T11:27:54+00:00',
            'startedAt' => '2026-09-23T11:26:55+00:00',
            'finishedAt' => '2026-09-23T11:27:54+00:00',
        ]);

        $this->assertSame('50fb3506-4127-4ba8-8296-f97dc7e3e0c3', $check->getIdentifier());
        $this->assertSame('finished', $check->getStatus());
        $this->assertSame(100, $check->getProgress());
        $this->assertSame([['key' => 'missing-context']], $check->getAttributes()['inspectors']);
        $this->assertSame('2026-09-23T11:26:54+00:00', $check->getCreatedAt());
        $this->assertSame('2026-09-23T11:27:54+00:00', $check->getUpdatedAt());
        $this->assertSame('2026-09-23T11:26:55+00:00', $check->getStartedAt());
        $this->assertSame('2026-09-23T11:27:54+00:00', $check->getFinishedAt());
    }

    public function testLoadDataWithoutOptionalFields(): void
    {
        $check = new AdvisorCheck(['identifier' => 'id', 'status' => 'created']);

        $this->assertNull($check->getStartedAt());
        $this->assertNull($check->getFinishedAt());
    }
}
