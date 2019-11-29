<?php

namespace CrowdinApiClient\Tests\Api\Enterprise;

use CrowdinApiClient\Model\Enterprise\DownloadFile;
use CrowdinApiClient\Model\Enterprise\TranslationMemory;
use CrowdinApiClient\Model\Enterprise\TranslationMemoryExport;
use CrowdinApiClient\Model\Enterprise\TranslationMemoryImport;
use CrowdinApiClient\ModelCollection;

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
        $this->assertInstanceOf(ModelCollection::class, $translationMemories);
        $this->assertCount(1, $translationMemories);
        $this->assertInstanceOf(TranslationMemory::class, $translationMemories[0]);
        $this->assertEquals(4, $translationMemories[0]->getId());
    }

    public function testCreate()
    {
        $params = [
            'name' => 'nowledge Base\'s TM',
            'groupId' => 2
        ];

        $this->mockRequest([
            'path' => '/tms',
            'method' => 'post',
            'body' => $params,
            'response' => '{
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
            }'
        ]);

        $translationMemory = $this->crowdin->translationMemory->create($params['name'], $params['groupId']);
        $this->assertInstanceOf(TranslationMemory::class, $translationMemory);
        $this->assertEquals(4, $translationMemory->getId());
    }

    public function testGetAndUpdate()
    {
        $this->mockRequestGet('/tms/4', '{
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
            }');

        $translationMemory = $this->crowdin->translationMemory->get(4);
        $this->assertInstanceOf(TranslationMemory::class, $translationMemory);
        $this->assertEquals(4, $translationMemory->getId());

        $this->mockRequestPath('/tms/4', '{
              "data": {
                "id": 4,
                "groupId": 2,
                "name": "test edit",
                "languageIds": [
                  "el"
                ],
                "segmentsCount": 21,
                "defaultProjectId": 0,
                "projectIds": [
                  2
                ]
              }
            }');

        $translationMemory->setName('test edit');

        $translationMemory = $this->crowdin->translationMemory->update($translationMemory);
        $this->assertInstanceOf(TranslationMemory::class, $translationMemory);
        $this->assertEquals(4, $translationMemory->getId());
        $this->assertEquals('test edit', $translationMemory->getName());
    }
    public function testDelete()
    {
        $this->mockRequestDelete('/tms/4');
        $this->crowdin->translationMemory->delete(4);
    }

    public function testDownload()
    {
        $this->mockRequestGet('/tms/4/exports', '{
          "data": {
            "url": "https://production-enterprise-importer.downloads.crowdin.com/992000002/2/14.xliff?response-content-disposition=attachment%3B%20filename%3D%22APP.xliff%22&X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAIGJKLQV66ZXPMMEA%2F20190920%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20190920T093121Z&X-Amz-SignedHeaders=host&X-Amz-Expires=3600&X-Amz-Signature=439ebd69a1b7e4c23e6d17891a491c94f832e0c82e4692dedb35a6cd1e624b62",
            "expireIn": "2019-09-20T10:31:21+00:00"
          }
        }');

        $downloadFile = $this->crowdin->translationMemory->download(4);
        $this->assertInstanceOf(DownloadFile::class, $downloadFile);
        $this->assertEquals('https://production-enterprise-importer.downloads.crowdin.com/992000002/2/14.xliff?response-content-disposition=attachment%3B%20filename%3D%22APP.xliff%22&X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAIGJKLQV66ZXPMMEA%2F20190920%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20190920T093121Z&X-Amz-SignedHeaders=host&X-Amz-Expires=3600&X-Amz-Signature=439ebd69a1b7e4c23e6d17891a491c94f832e0c82e4692dedb35a6cd1e624b62', $downloadFile->getUrl());
    }

    public function testExport()
    {
        $params = [
            'sourceLanguageId' => 'en',
            'targetLanguageId' => 'de',
            'format' => 'tmx',
        ];
        $this->mockRequest([
            'path' => '/tms/4/exports',
            'method' => 'post',
            'body' => $params,
            'response' => '{
              "data": {
                "identifier": "50fb3506-4127-4ba8-8296-f97dc7e3e0c3",
                "status": "finished",
                "progress": 100,
                "attributes": {
                  "sourceLanguageId": "en",
                  "targetLanguageId": "de",
                  "format": "csv",
                  "tmId": 4,
                  "userId": 6
                },
                "createdAt": "2019-09-23T11:26:54+00:00",
                "updatedAt": "2019-09-23T11:26:54+00:00",
                "startedAt": "2019-09-23T11:26:54+00:00",
                "finishedAt": "2019-09-23T11:26:54+00:00",
                "eta": "1 second"
              }
            }'
        ]);

        $export = $this->crowdin->translationMemory->export(4);
        $this->assertInstanceOf(TranslationMemoryExport::class, $export);
        $this->assertEquals('50fb3506-4127-4ba8-8296-f97dc7e3e0c3', $export->getIdentifier());
    }

    public function testGetExport()
    {
        $this->mockRequestGet('/tms/4/exports/50fb3506-4127-4ba8-8296-f97dc7e3e0c3', '{
              "data": {
                "identifier": "50fb3506-4127-4ba8-8296-f97dc7e3e0c3",
                "status": "finished",
                "progress": 100,
                "attributes": {
                  "sourceLanguageId": "en",
                  "targetLanguageId": "de",
                  "format": "csv",
                  "tmId": 4,
                  "userId": 6
                },
                "createdAt": "2019-09-23T11:26:54+00:00",
                "updatedAt": "2019-09-23T11:26:54+00:00",
                "startedAt": "2019-09-23T11:26:54+00:00",
                "finishedAt": "2019-09-23T11:26:54+00:00",
                "eta": "1 second"
              }
            }');

        $export = $this->crowdin->translationMemory->checkExportStatus(4, '50fb3506-4127-4ba8-8296-f97dc7e3e0c3');
        $this->assertInstanceOf(TranslationMemoryExport::class, $export);
        $this->assertEquals('50fb3506-4127-4ba8-8296-f97dc7e3e0c3', $export->getIdentifier());
    }

    public function testImport()
    {
        $params = [
            'storageId' => 0,
            'firstLineContainsHeader' => false,
            'scheme' =>
                [
                    'phraseEn' => 0,
                    'phraseDe' => 1,
                    'phrasePl' => 2,
                    'phraseUk' => 4,
                ],
        ];

        $this->mockRequest([
            'path' => '/tms/4/imports',
            'method' => 'post',
            'body' => $params,
            'response' => '{
                      "data": {
                        "identifier": "b5215a34-1305-4b21-8054-fc2eb252842f",
                        "status": "created",
                        "progress": 0,
                        "attributes": {
                          "tmId": 10,
                          "storageId": 28,
                          "firstLineContainsHeader": 10,
                          "scheme": {
                            "phraseEn": 52,
                            "phraseEl": 52
                          },
                          "organizationId": 200000299,
                          "progressKey": "import_tm_progress_10",
                          "userId": 6
                        },
                        "createdAt": "2019-09-23T11:51:08+00:00",
                        "updatedAt": "2019-09-23T11:51:08+00:00",
                        "startedAt": "string",
                        "finishedAt": "string",
                        "eta": "1 second"
                      }
                    }'
        ]);

        $translationMemoryImport = $this->crowdin->translationMemory->import(4, 0, $params);
        $this->assertInstanceOf(TranslationMemoryImport::class, $translationMemoryImport);
        $this->assertEquals('b5215a34-1305-4b21-8054-fc2eb252842f', $translationMemoryImport->getIdentifier());
    }

    public function testCheckImportStatus()
    {
        $this->mockRequestGet('/tms/4/imports/b5215a34-1305-4b21-8054-fc2eb252842f', '{
              "data": {
                "identifier": "b5215a34-1305-4b21-8054-fc2eb252842f",
                "status": "created",
                "progress": 0,
                "attributes": {
                  "tmId": 10,
                  "storageId": 28,
                  "firstLineContainsHeader": 10,
                  "scheme": {
                    "phraseEn": 52,
                    "phraseEl": 52
                  },
                  "organizationId": 200000299,
                  "progressKey": "import_tm_progress_10",
                  "userId": 6
                },
                "createdAt": "2019-09-23T11:51:08+00:00",
                "updatedAt": "2019-09-23T11:51:08+00:00",
                "startedAt": "string",
                "finishedAt": "string",
                "eta": "1 second"
              }
            }');

        $translationMemoryImport = $this->crowdin->translationMemory->checkImportStatus(4, 'b5215a34-1305-4b21-8054-fc2eb252842f');
        $this->assertInstanceOf(TranslationMemoryImport::class, $translationMemoryImport);
        $this->assertEquals('b5215a34-1305-4b21-8054-fc2eb252842f', $translationMemoryImport->getIdentifier());
    }
}
