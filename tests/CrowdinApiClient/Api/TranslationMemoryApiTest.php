<?php

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\TranslationMemory;

class TranslationMemoryApiTest extends AbstractTestApi
{
    public function testList()
    {
        $this->mockRequest([
            'path' => '/tms',
            'method' => 'get',
            'response' => '{
              "data": [
                {
                  "data": {
                    "id": 4,
                    "groupId": 2,
                    "name": "Knowledge Base\'s TM",
                    "languageIds": [
                      "el"
                    ],
                    "segmentsCount": 21,
                    "defaultProjectId": 0,
                    "projectIds": [
                      2
                    ]
                  }
                }
              ],
              "pagination": [
                {
                  "offset": 0,
                  "limit": 0
                }
              ]
            }'
        ]);

        $translationMemories = $this->crowdin->translationMemory->list(2);
        $this->assertIsArray($translationMemories);
        $this->assertCount(1, $translationMemories);
        $this->assertInstanceOf(TranslationMemory::class, $translationMemories[0]);
        $this->assertEquals(4, $translationMemories[0]->getId());
    }
}
