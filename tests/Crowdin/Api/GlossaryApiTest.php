<?php

namespace Crowdin\Tests\Api;

use Crowdin\Model\Glossary;
use Crowdin\Model\GlossaryExport;

class GlossaryApiTest extends AbstractTestApi
{
    public function testList()
    {
        $this->mockRequest([
            'path' => '/glossaries',
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

    public function testCreate()
    {
        $params = [
            'name' => 'Be My Eyes iOS\'s Glossary',
            'groupId' => 2
        ];

        $this->mockRequest([
            'path' => '/glossaries',
            'method' => 'post',
            'body' => $params,
            'response' => '{
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
                }'
        ]);

        $glossary = $this->crowdin->glossary->create('Be My Eyes iOS\'s Glossary', 2);
        $this->assertInstanceOf(Glossary::class, $glossary);
        $this->assertEquals(2, $glossary->getId());
    }

    public function testGet()
    {
        $this->mockRequestGet('/glossaries/2', '{
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
            }');

        $glossary = $this->crowdin->glossary->get(2);
        $this->assertInstanceOf(Glossary::class, $glossary);
        $this->assertEquals(2, $glossary->getId());
    }

    public function testDelete()
    {
        $this->mockRequestDelete('/glossaries/2');
        $this->crowdin->glossary->delete(2);
    }

    public function testExport()
    {
        $this->mockRequest([
            'path' => '/glossaries/2/exports',
            'method' => 'post',
            'body' => [
                'format' => 'tbx',
            ],
            'response' => '{
                  "data": {
                    "identifier": "5ed2ce93-6d47-4402-9e66-516ca835cb20",
                    "status": "created",
                    "progress": 0,
                    "attributes": {
                      "format": "csv",
                      "organizationId": 200000299,
                      "glossaryId": 6
                    },
                    "createdAt": "2019-09-23T07:06:43+00:00",
                    "updatedAt": "2019-09-23T07:06:43+00:00",
                    "startedAt": "2019-11-13T08:17:23Z",
                    "finishedAt": "2019-11-13T08:17:23Z",
                    "eta": "1 second"
                  }
                }'
        ]);


        $glossaryExport = $this->crowdin->glossary->export(2);
        $this->assertInstanceOf(GlossaryExport::class, $glossaryExport);
        $this->assertEquals('5ed2ce93-6d47-4402-9e66-516ca835cb20', $glossaryExport->getIdentifier());
    }

    public function testDownload()
    {
        //TODO
        $this->assertEquals(1,1);
    }
}
