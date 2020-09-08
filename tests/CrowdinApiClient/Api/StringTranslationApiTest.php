<?php

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\IcuLanguageTranslation;
use CrowdinApiClient\Model\LanguageTranslation;
use CrowdinApiClient\Model\PlainLanguageTranslation;
use CrowdinApiClient\Model\PluralLanguageTranslation;
use CrowdinApiClient\Model\StringTranslation;
use CrowdinApiClient\ModelCollection;

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
        $this->assertInstanceOf(ModelCollection::class, $stringTranslations);
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
            }');

        $stringTranslation = $this->crowdin->stringTranslation->get(2, 190695);
        $this->assertInstanceOf(StringTranslation::class, $stringTranslation);
        $this->assertEquals(190695, $stringTranslation->getId());
    }

    public function testDelete()
    {
        $this->mockRequestDelete('/projects/2/translations/190695');
        $this->crowdin->stringTranslation->delete(2, 190695);
    }

    public function create()
    {
        $params = [
            'stringId' => 35434,
            'languageId' => 'uk',
            'text' => 'Цю стрічку перекладено',
            'pluralCategoryName' => 'few',
        ];

        $this->mockRequest([
            'path' => '',
            'method' => 'post',
            'body' => $params,
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

        $stringTranslation = $this->crowdin->stringTranslation->create(2, $params);
        $this->assertInstanceOf(StringTranslation::class, $stringTranslation);
        $this->assertEquals(190695, $stringTranslation->getId());
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

    public function testCreate()
    {
        $params = [
            'stringId' => 35434,
            'languageId' => 'uk',
            'text' => 'Цю стрічку перекладено',
            'pluralCategoryName' => 'few',
        ];

        $this->mockRequest([
            'path' => '/projects/2/translations',
            'method' => 'post',
            'body' => $params,
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
                }',
        ]);

        $stringTranslation = $this->crowdin->stringTranslation->create(2, $params);
        $this->assertInstanceOf(StringTranslation::class, $stringTranslation);
        $this->assertEquals(190695, $stringTranslation->getId());
    }

    public function testDeleteStringTranslations()
    {
        $params = [
            'stringId' => 1,
            'languageId' => 'en'
        ];

        $this->mockRequest([
            'path' => '/projects/1/translations',
            'method' => 'delete',
            'body' => $params,
            'response' => '',
        ]);

        $this->crowdin->stringTranslation->deleteStringTranslations(1, 1, 'en');
    }

    public function testListLanguageTranslations()
    {
        $params = [
            'stringsId' => '12,7815,9011',
            'fileId' => 5,
        ];

        $this->mockRequest([
            'path' => '/projects/2/languages/en/translations',
            'method' => 'get',
            'response' => '{
              "data": [
                {
                  "data": {
                    "stringId": 12,
                    "contentType": "text/plain",
                    "translationId": 1,
                    "text": "Confirm New Password"
                  }
                },
                {
                  "data": {
                    "stringId": 7815,
                    "contentType": "application/vnd.crowdin.text+plural",
                    "translationId": 2,
                    "text": "Confirm New Password"
                  }
                },
                {
                  "data": {
                    "stringId": 9011,
                    "contentType": "application/vnd.crowdin.text+icu",
                    "translationId": 3,
                    "text": "Confirm New Password"
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

        $stringTranslations = $this->crowdin->stringTranslation->listLanguageTranslations(2, 'en');
        $this->assertInstanceOf(ModelCollection::class, $stringTranslations);
        $this->assertCount(3, $stringTranslations);
        $this->assertInstanceOf(LanguageTranslation::class, $stringTranslations[0]);
        $this->assertInstanceOf(LanguageTranslation::class, $stringTranslations[1]);
        $this->assertInstanceOf(LanguageTranslation::class, $stringTranslations[2]);
        $this->assertEquals(12, $stringTranslations[0]->getStringId());
        $this->assertEquals(7815, $stringTranslations[1]->getStringId());
        $this->assertEquals(9011, $stringTranslations[2]->getStringId());
    }
}
