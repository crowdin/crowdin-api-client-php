<?php

namespace Crowdin\Tests\Api;

use Crowdin\Model\StringTranslation;

class StringTranslationApiTest extends AbstractTestApi
{
    public function testList()
    {
        $this->mockRequest([
            'path' => '/projects/2/translations',
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

    public function testGet()
    {
        $this->mockRequestGet('/projects/2/translations/190695', '{
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
            }') ;

        $stringTranslation = $this->crowdin->stringTranslation->get(2, 190695);
        $this->assertInstanceOf(StringTranslation::class, $stringTranslation);
        $this->assertEquals(190695, $stringTranslation->getId());
    }

    public function testDelete()
    {
        $this->mockRequestDelete('/projects/2/translations/190695');
        $this->crowdin->stringTranslation->delete(2, 190695);
    }

    public function testRestore()
    {
        $this->mockRequest([
           'path' => '/projects/2/translations/190695/restore',
           'method' => 'post',
           'response' => '{
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
                }'
        ]);

        $stringTranslation = $this->crowdin->stringTranslation->restore(2, 190695);
        $this->assertInstanceOf(StringTranslation::class, $stringTranslation);
        $this->assertEquals(190695, $stringTranslation->getId());
    }

}
