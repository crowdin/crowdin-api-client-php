<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\AiMemberUsage;
use PHPUnit\Framework\TestCase;

class AiMemberUsageTest extends TestCase
{
    public function testLoadData(): void
    {
        $user = ['id' => 12, 'username' => 'john', 'fullName' => 'John Smith', 'avatarUrl' => ''];
        $usage = new AiMemberUsage([
            'user' => $user,
            'dailyCostLimit' => 5,
            'dailyCostSpent' => 1.25,
            'dailyResetAt' => '2025-09-24T00:00:00+00:00',
            'monthlyCostLimit' => 100.5,
            'monthlyCostSpent' => 10,
            'monthlyResetAt' => '2025-10-01T00:00:00+00:00',
        ]);

        $this->assertSame($user, $usage->getUser());
        $this->assertSame(5.0, $usage->getDailyCostLimit());
        $this->assertSame(1.25, $usage->getDailyCostSpent());
        $this->assertSame('2025-09-24T00:00:00+00:00', $usage->getDailyResetAt());
        $this->assertSame(100.5, $usage->getMonthlyCostLimit());
        $this->assertSame(10.0, $usage->getMonthlyCostSpent());
        $this->assertSame('2025-10-01T00:00:00+00:00', $usage->getMonthlyResetAt());
    }

    public function testLoadDataWithoutLimits(): void
    {
        $usage = new AiMemberUsage([
            'user' => ['id' => 12],
            'dailyCostLimit' => null,
            'dailyCostSpent' => 0,
            'monthlyCostLimit' => null,
            'monthlyCostSpent' => 0,
        ]);

        $this->assertNull($usage->getDailyCostLimit());
        $this->assertNull($usage->getMonthlyCostLimit());
    }
}
