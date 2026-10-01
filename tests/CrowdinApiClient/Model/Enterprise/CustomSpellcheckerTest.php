<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model\Enterprise;

use CrowdinApiClient\Model\Enterprise\CustomSpellchecker;
use PHPUnit\Framework\TestCase;

class CustomSpellcheckerTest extends TestCase
{
    public function testLoadData(): void
    {
        $config = [
            'identifier' => 'company-terms',
            'key' => 'spellchecker',
            'realTimeCheckEnabled' => true,
            'enabledLanguageIds' => ['uk'],
        ];
        $spellchecker = new CustomSpellchecker([
            'id' => 4,
            'name' => 'Company terms',
            'config' => $config,
            'createdAt' => '2026-09-01T10:00:00+00:00',
            'updatedAt' => '2026-09-02T10:00:00+00:00',
        ]);

        $this->assertSame(4, $spellchecker->getId());
        $this->assertSame('Company terms', $spellchecker->getName());
        $this->assertSame($config, $spellchecker->getConfig());
        $this->assertSame('2026-09-01T10:00:00+00:00', $spellchecker->getCreatedAt());
        $this->assertSame('2026-09-02T10:00:00+00:00', $spellchecker->getUpdatedAt());
    }

    public function testLoadDataWithoutUpdatedAt(): void
    {
        $this->assertNull((new CustomSpellchecker(['id' => 4]))->getUpdatedAt());
    }
}
