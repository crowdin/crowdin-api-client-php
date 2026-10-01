<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\ReportArchive;
use PHPUnit\Framework\TestCase;

class ReportArchiveTest extends TestCase
{
    public function testLoadAdditionalFields(): void
    {
        $model = new ReportArchive([
            'progress' => 7,
            'status' => 'value',
        ]);

        $this->assertSame(7, $model->getProgress());
        $this->assertSame('value', $model->getStatus());
    }

    public function testAdditionalFieldsWhenMissing(): void
    {
        $model = new ReportArchive([]);

        $this->assertSame(0, $model->getProgress());
        $this->assertSame('', $model->getStatus());
    }
}
