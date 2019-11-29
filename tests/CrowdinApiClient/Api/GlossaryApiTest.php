<?php

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\DownloadFile;
use CrowdinApiClient\Model\Glossary;
use CrowdinApiClient\Model\GlossaryExport;
use CrowdinApiClient\ModelCollection;

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

        $this->assertInstanceOf(ModelCollection::class, $glossaries);
        $this->assertCount(1, $glossaries);
        $this->assertInstanceOf(Glossary::class, $glossaries[0]);
        $this->assertEquals(2, $glossaries[0]->getId());
    }

    public function testCreate()
    {
        $params = [
            'name' => 'Be My Eyes iOS\'s Glossary',
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

        $glossary = $this->crowdin->glossary->create('Be My Eyes iOS\'s Glossary');
        $this->assertInstanceOf(Glossary::class, $glossary);
        $this->assertEquals(2, $glossary->getId());
    }

    public function testGetAndUpdate()
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

        $glossary->setName('edit test');

        $this->mockRequestPath('/glossaries/2', '{
              "data": {
                "id": 2,
                "name": "edit test",
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

        $glossary = $this->crowdin->glossary->update($glossary);
        $this->assertInstanceOf(Glossary::class, $glossary);
        $this->assertEquals(2, $glossary->getId());
        $this->assertEquals('edit test', $glossary->getName());
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
        $this->mockRequestGet('/glossaries/2/exports/download', '{
          "data": {
            "url": "https://production-enterprise-importer.downloads.crowdin.com/992000002/2/14.xliff?response-content-disposition=attachment%3B%20filename%3D%22APP.xliff%22&X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAIGJKLQV66ZXPMMEA%2F20190920%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20190920T093121Z&X-Amz-SignedHeaders=host&X-Amz-Expires=3600&X-Amz-Signature=439ebd69a1b7e4c23e6d17891a491c94f832e0c82e4692dedb35a6cd1e624b62",
            "expireIn": "2019-09-20T10:31:21+00:00"
          }
        }');

        $downloadFile = $this->crowdin->glossary->download(2);
        $this->assertInstanceOf(DownloadFile::class, $downloadFile);
        $this->assertEquals('https://production-enterprise-importer.downloads.crowdin.com/992000002/2/14.xliff?response-content-disposition=attachment%3B%20filename%3D%22APP.xliff%22&X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAIGJKLQV66ZXPMMEA%2F20190920%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20190920T093121Z&X-Amz-SignedHeaders=host&X-Amz-Expires=3600&X-Amz-Signature=439ebd69a1b7e4c23e6d17891a491c94f832e0c82e4692dedb35a6cd1e624b62', $downloadFile->getUrl());
    }
}
