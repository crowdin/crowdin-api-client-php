<?php

namespace Crowdin\Tests\Api;

use Crowdin\Model\SourceString;

class SourceStringApiTest extends AbstractTestApi
{
    public function testList()
    {
        $this->mockRequest([
            'path' => '/projects/2/strings',
            'method' => 'get',
            'response' => '{
              "data": [
                {
                  "data": {
                    "id": 2814,
                    "projectId": 2,
                    "fileId": 48,
                    "identifier": "6a1821e6499ebae94de4b880fd93b985",
                    "text": "Not all videos are shown to users. See more",
                    "type": "text",
                    "context": "shown on main page",
                    "maxLength": 35,
                    "isHidden": false,
                    "revision": 1,
                    "hasPlurals": false,
                    "plurals": {},
                    "isIcu": false,
                    "createdAt": "2019-09-20T12:43:57+00:00",
                    "updatedAt": "2019-09-20T13:24:01+00:00"
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

        $sourceStrings = $this->crowdin->sourceString->list(2);

        $this->assertIsArray($sourceStrings);
        $this->assertCount(1, $sourceStrings);
        $this->assertInstanceOf(SourceString::class, $sourceStrings[0]);
        $this->assertEquals(2814, $sourceStrings[0]->getId());
    }

    public function testGet()
    {
        $this->mockRequestGet('/projects/2/strings/2814', '{
          "data": {
            "id": 2814,
            "projectId": 2,
            "fileId": 48,
            "identifier": "6a1821e6499ebae94de4b880fd93b985",
            "text": "Not all videos are shown to users. See more",
            "type": "text",
            "context": "shown on main page",
            "maxLength": 35,
            "isHidden": false,
            "revision": 1,
            "hasPlurals": false,
            "plurals": {},
            "isIcu": false,
            "createdAt": "2019-09-20T12:43:57+00:00",
            "updatedAt": "2019-09-20T13:24:01+00:00"
          }
        }');

        $sourceString = $this->crowdin->sourceString->get(2, 2814);
        $this->assertInstanceOf(SourceString::class, $sourceString);
        $this->assertEquals(2814, $sourceString->getId());
    }

    public function testCreate()
    {
        $params = [
            'identifier' => 'identifier',
            'text' => 'Not all videos are shown to users. See more'
        ];

        $this->mockRequest([
            'path' => '/projects/2/strings',
            'method' => 'post',
            'response' => '{
                  "data": {
                    "id": 2814,
                    "projectId": 2,
                    "fileId": 48,
                    "identifier": "6a1821e6499ebae94de4b880fd93b985",
                    "text": "Not all videos are shown to users. See more",
                    "type": "text",
                    "context": "shown on main page",
                    "maxLength": 35,
                    "isHidden": false,
                    "revision": 1,
                    "hasPlurals": false,
                    "plurals": {},
                    "isIcu": false,
                    "createdAt": "2019-09-20T12:43:57+00:00",
                    "updatedAt": "2019-09-20T13:24:01+00:00"
                  }
                }',
            'body' => $params
        ]);

        $sourceString = $this->crowdin->sourceString->create(2, $params);

        $this->assertInstanceOf(SourceString::class, $sourceString);
        $this->assertEquals(2814, $sourceString->getId());
    }

    public function testDelete()
    {
        $this->mockRequest([
            'path' => '/projects/2/strings/2814',
            'method' => 'delete',
        ]);

        $this->crowdin->sourceString->delete(2, 2814);
    }


}
