<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\AiReport;
use PHPUnit\Framework\TestCase;

class AiReportTest extends TestCase
{
    public function testLoadAdditionalFields(): void
    {
        $model = new AiReport([
            'eta' => 'value',
        ]);

        $this->assertSame('value', $model->getEta());
    }

    public function testAdditionalFieldsWhenMissing(): void
    {
        $model = new AiReport([]);

        $this->assertNull($model->getEta());
    }
}
