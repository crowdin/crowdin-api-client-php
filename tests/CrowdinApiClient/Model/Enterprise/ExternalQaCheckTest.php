<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model\Enterprise;

use CrowdinApiClient\Model\Enterprise\ExternalQaCheck;
use PHPUnit\Framework\TestCase;

class ExternalQaCheckTest extends TestCase
{
    public function testLoadData(): void
    {
        $qaCheck = new ExternalQaCheck([
            'id' => 6,
            'name' => 'Brand voice',
            'description' => 'Checks brand terms',
            'config' => ['identifier' => 'brand-voice'],
            'createdAt' => '2026-09-01T10:00:00+00:00',
            'updatedAt' => '2026-09-02T10:00:00+00:00',
        ]);

        $this->assertSame(6, $qaCheck->getId());
        $this->assertSame('Brand voice', $qaCheck->getName());
        $this->assertSame('Checks brand terms', $qaCheck->getDescription());
        $this->assertSame(['identifier' => 'brand-voice'], $qaCheck->getConfig());
        $this->assertSame('2026-09-01T10:00:00+00:00', $qaCheck->getCreatedAt());
        $this->assertSame('2026-09-02T10:00:00+00:00', $qaCheck->getUpdatedAt());
    }

    public function testLoadDataWithoutOptionalFields(): void
    {
        $qaCheck = new ExternalQaCheck(['id' => 6, 'name' => 'Brand voice']);

        $this->assertNull($qaCheck->getDescription());
        $this->assertNull($qaCheck->getUpdatedAt());
    }
}
