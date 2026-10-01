<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Api\Enterprise;

use CrowdinApiClient\Model\Enterprise\CustomSpellchecker;
use CrowdinApiClient\ModelCollection;

class CustomSpellcheckerApiTest extends AbstractTestApi
{
    private function spellcheckerData(): array
    {
        return [
            'id' => 4,
            'name' => 'Company terms',
            'config' => [
                'identifier' => 'company-terms',
                'key' => 'spellchecker',
                'realTimeCheckEnabled' => true,
                'enabledLanguageIds' => ['uk'],
            ],
            'createdAt' => '2026-09-01T10:00:00+00:00',
            'updatedAt' => null,
        ];
    }

    public function testList(): void
    {
        $this->mockRequestGet(
            '/custom-spellcheckers',
            json_encode([
                'data' => [['data' => $this->spellcheckerData()]],
                'pagination' => ['offset' => 0, 'limit' => 25],
            ])
        );

        $spellcheckers = $this->crowdin->customSpellchecker->list();

        $this->assertInstanceOf(ModelCollection::class, $spellcheckers);
        $this->assertCount(1, $spellcheckers);
        $this->assertInstanceOf(CustomSpellchecker::class, $spellcheckers[0]);
    }

    public function testGet(): void
    {
        $this->mockRequestGet('/custom-spellcheckers/4', json_encode(['data' => $this->spellcheckerData()]));

        $spellchecker = $this->crowdin->customSpellchecker->get(4);

        $this->assertInstanceOf(CustomSpellchecker::class, $spellchecker);
        $this->assertEquals('Company terms', $spellchecker->getName());
    }
}
