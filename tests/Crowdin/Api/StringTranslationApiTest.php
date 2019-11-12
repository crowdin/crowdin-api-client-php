<?php

namespace Crowdin\Tests\Api;

use Crowdin\Model\StringTranslation;

class StringTranslationApiTest extends AbstractTestApi
{
    public function testList()
    {
        $this->mockRequestTest([
            'uri' => 'https://organization_domain.crowdin.com/api/v2/projects/2/translations',
            'method' => 'get',
            'response' => '{
              "data": [
                {
                  "data": {
                    "id": 190695,
                    "text": "Цю стрічку перекладено",
                    "pluralCategoryName": "few",
                    "user": {
                      "id": 19,
                      "login": "john_doe"
                    },
                    "rating": 10
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

        $stringTranslations = $this->crowdin->stringTranslation->list(2);
        $this->assertIsArray($stringTranslations);
        $this->assertCount(1, $stringTranslations);
        $this->assertInstanceOf(StringTranslation::class, $stringTranslations[0]);
        $this->assertEquals(190695, $stringTranslations[0]->getId());
    }
}
