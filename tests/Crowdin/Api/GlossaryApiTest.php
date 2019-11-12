<?php

namespace Crowdin\Tests\Api;

use Crowdin\Model\Glossary;

class GlossaryApiTest extends AbstractTestApi
{
    public function testList()
    {
        $this->mockRequestTest([
            'uri' => 'https://organization_domain.crowdin.com/api/v2/glossaries',
            'method' => 'get',
            'response' => '{
                  "data": [
                    {
                      "data": {
                        "id": 2,
                        "name": "Be My Eyes iOS\'s Glossary",
                        "groupId": 2,
                        "userId": 2,
                        "terms": 25,
                        "languageIds": [
                          "ro"
                        ],
                        "projectIds": [
                          6
                        ],
                        "createdAt": "2019-09-16T13:42:04+00:00"
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

        $glossaries = $this->crowdin->glossary->list();

        $this->assertIsArray($glossaries);
        $this->assertCount(1, $glossaries);
        $this->assertInstanceOf(Glossary::class, $glossaries[0]);
        $this->assertEquals(2, $glossaries[0]->getId());
    }
}
