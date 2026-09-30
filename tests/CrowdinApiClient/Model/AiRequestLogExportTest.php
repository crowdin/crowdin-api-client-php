<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\AiRequestLogExport;
use PHPUnit\Framework\TestCase;

class AiRequestLogExportTest extends TestCase
{
    public function testLoadData(): void
    {
        $export = new AiRequestLogExport([
            'identifier' => 'e7c1d7f2-1111-4222-8333-444455556666',
            'status' => 'finished',
            'progress' => 100,
            'attributes' => ['format' => 'csv', 'filters' => ['projectId' => 1]],
            'createdAt' => '2025-09-23T11:26:54+00:00',
            'updatedAt' => '2025-09-23T11:27:54+00:00',
            'startedAt' => '2025-09-23T11:26:55+00:00',
            'finishedAt' => '2025-09-23T11:27:54+00:00',
            'eta' => '0 seconds',
        ]);

        $this->assertSame('e7c1d7f2-1111-4222-8333-444455556666', $export->getIdentifier());
        $this->assertSame('finished', $export->getStatus());
        $this->assertSame(100, $export->getProgress());
        $this->assertSame('csv', $export->getAttributes()['format']);
        $this->assertSame('2025-09-23T11:27:54+00:00', $export->getFinishedAt());
        $this->assertSame('0 seconds', $export->getEta());
    }

    public function testLoadDataWithoutOptionalFields(): void
    {
        $export = new AiRequestLogExport([
            'identifier' => 'e7c1d7f2-1111-4222-8333-444455556666',
            'status' => 'created',
            'progress' => 0,
            'attributes' => ['format' => 'csv', 'filters' => []],
            'createdAt' => '2025-09-23T11:26:54+00:00',
        ]);

        $this->assertNull($export->getStartedAt());
        $this->assertNull($export->getFinishedAt());
        $this->assertNull($export->getEta());
    }
}
