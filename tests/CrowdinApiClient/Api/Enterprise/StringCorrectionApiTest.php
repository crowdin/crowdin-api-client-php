<?php

namespace CrowdinApiClient\Tests\Api\Enterprise;

use CrowdinApiClient\Model\StringCorrection;
use CrowdinApiClient\ModelCollection;

class StringCorrectionApiTest extends AbstractTestApi
{
    public function testList(): void
    {
        $this->mockRequest([
            'path' => '/projects/2/corrections',
            'method' => 'get',
            'response' => '{
              "data": [
                {
                  "data": {
                    "id": 190695,
                    "text": "This string has been corrected",
                    "pluralCategoryName": "few",
                    "user": {
                      "id": 19,
                      "username": "john_doe",
                      "fullName": "John Smith",
                      "avatarUrl": ""
                    },
                    "createdAt": "2019-09-23T11:26:54+00:00"
                  }
                }
              ],
              "pagination": {
                "offset": 0,
                "limit": 25
              }
            }',
        ]);

        $corrections = $this->crowdin->stringCorrection->list(2);

        $this->assertInstanceOf(ModelCollection::class, $corrections);
        $this->assertCount(1, $corrections);
        $this->assertInstanceOf(StringCorrection::class, $corrections[0]);
        $this->assertEquals(190695, $corrections[0]->getId());
    }

    public function testGet(): void
    {
        $this->mockRequestGet(
            '/projects/2/corrections/190695',
            '{
              "data": {
                "id": 190695,
                "text": "This string has been corrected",
                "pluralCategoryName": "few",
                "user": {
                  "id": 19,
                  "username": "john_doe",
                  "fullName": "John Smith",
                  "avatarUrl": ""
                },
                "createdAt": "2019-09-23T11:26:54+00:00"
              }
            }'
        );

        $correction = $this->crowdin->stringCorrection->get(2, 190695);

        $this->assertInstanceOf(StringCorrection::class, $correction);
        $this->assertEquals(190695, $correction->getId());
        $this->assertEquals('This string has been corrected', $correction->getText());
    }

    public function testCreate(): void
    {
        $params = [
            'stringId' => 123,
            'text' => 'Corrected string text',
            'pluralCategoryName' => 'few',
        ];

        $this->mockRequest([
            'path' => '/projects/2/corrections',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => '{
              "data": {
                "id": 190696,
                "text": "Corrected string text",
                "pluralCategoryName": "few",
                "user": {
                  "id": 19,
                  "username": "john_doe",
                  "fullName": "John Smith",
                  "avatarUrl": ""
                },
                "createdAt": "2019-09-23T11:26:54+00:00"
              }
            }',
        ]);

        $correction = $this->crowdin->stringCorrection->create(2, $params);

        $this->assertInstanceOf(StringCorrection::class, $correction);
        $this->assertEquals(190696, $correction->getId());
        $this->assertEquals('Corrected string text', $correction->getText());
    }

    public function testRestore(): void
    {
        $this->mockRequest([
            'path' => '/projects/2/corrections/190695',
            'method' => 'put',
            'response' => '{
              "data": {
                "id": 190695,
                "text": "This string has been corrected",
                "pluralCategoryName": "few",
                "user": {
                  "id": 19,
                  "username": "john_doe",
                  "fullName": "John Smith",
                  "avatarUrl": ""
                },
                "createdAt": "2019-09-23T11:26:54+00:00"
              }
            }',
        ]);

        $correction = $this->crowdin->stringCorrection->restore(2, 190695);

        $this->assertInstanceOf(StringCorrection::class, $correction);
        $this->assertEquals(190695, $correction->getId());
    }

    public function testDelete(): void
    {
        $this->mockRequestDelete('/projects/2/corrections/190695');
        $this->crowdin->stringCorrection->delete(2, 190695);
    }
}
