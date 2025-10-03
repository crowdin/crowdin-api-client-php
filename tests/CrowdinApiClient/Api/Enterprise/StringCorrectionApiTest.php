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
}
