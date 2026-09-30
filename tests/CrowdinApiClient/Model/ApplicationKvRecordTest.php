<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\ApplicationKvRecord;
use PHPUnit\Framework\TestCase;

class ApplicationKvRecordTest extends TestCase
{
    public function testLoadData(): void
    {
        $record = new ApplicationKvRecord([
            'key' => 'user:1:token',
            'value' => ['color' => 'dark'],
            'secret' => true,
            'createdAt' => '2026-09-01T10:00:00+00:00',
            'updatedAt' => '2026-09-02T10:00:00+00:00',
            'expiresAt' => '2026-10-01T10:00:00+00:00',
        ]);

        $this->assertSame('user:1:token', $record->getKey());
        $this->assertSame(['color' => 'dark'], $record->getValue());
        $this->assertTrue($record->isSecret());
        $this->assertSame('2026-09-01T10:00:00+00:00', $record->getCreatedAt());
        $this->assertSame('2026-09-02T10:00:00+00:00', $record->getUpdatedAt());
        $this->assertSame('2026-10-01T10:00:00+00:00', $record->getExpiresAt());
    }

    public function testScalarValueAndNoExpiry(): void
    {
        $record = new ApplicationKvRecord(['key' => 'counter', 'value' => 42]);

        $this->assertSame(42, $record->getValue());
        $this->assertFalse($record->isSecret());
        $this->assertNull($record->getExpiresAt());
    }
}
