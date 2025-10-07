<?php

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\DownloadFile;
use CrowdinApiClient\Model\TranslationMemory;
use CrowdinApiClient\Model\TranslationMemoryConcordance;
use CrowdinApiClient\Model\TranslationMemoryExport;
use CrowdinApiClient\Model\TranslationMemoryImport;
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
                    "defaultProjectIds": [0],
                    "projectIds": [
                      2
                    ]
                  }
                }
              ],
              "pagination": [
                {
                  "offset": 0,
                  "limit": 25
                }
              ]
            }'
        ]);

        $translationMemories = $this->crowdin->translationMemory->list();
        $this->assertInstanceOf(ModelCollection::class, $translationMemories);
        $this->assertCount(1, $translationMemories);
        $this->assertInstanceOf(TranslationMemory::class, $translationMemories[0]);
        $this->assertEquals(4, $translationMemories[0]->getId());
    }

    public function testCreate()
    {
        $params = [
            'name' => 'knowledge Base\'s TM',
        ];

        $this->mockRequest([
            'path' => '/tms',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => '{
              "data": {
                "id": 4,
                "groupId": 2,
                "name": "Knowledge Base\'s TM",
                "languageIds": [
                  "el"
                ],
                "segmentsCount": 21,
                "defaultProjectIds": [0],
                "projectIds": [
                  2
                ],
                "createdAt":"2019-09-23T09:04:29+00:00"
              }
            }'
        ]);

        $translationMemory = $this->crowdin->translationMemory->create($params);
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
                "defaultProjectIds": [0],
                "projectIds": [
                  2
                ]
              }
            }');

        $translationMemory = $this->crowdin->translationMemory->get(4);
        $this->assertInstanceOf(TranslationMemory::class, $translationMemory);
        $this->assertEquals(4, $translationMemory->getId());

        $this->mockRequestPatch('/tms/4', '{
              "data": {
                "id": 4,
                "groupId": 2,
                "name": "test edit",
                "languageIds": [
                  "el"
                ],
                "segmentsCount": 21,
                "defaultProjectIds": [0],
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
        $this->mockRequestGet('/tms/4/exports/1/download', '{
          "data": {
            "url": "https://production-enterprise-importer.downloads.crowdin.com/992000002/2/14.xliff?response-content-disposition=attachment%3B%20filename%3D%22APP.xliff%22&X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAIGJKLQV66ZXPMMEA%2F20190920%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20190920T093121Z&X-Amz-SignedHeaders=host&X-Amz-Expires=3600&X-Amz-Signature=439ebd69a1b7e4c23e6d17891a491c94f832e0c82e4692dedb35a6cd1e624b62",
            "expireIn": "2019-09-20T10:31:21+00:00"
          }
        }');

        $downloadFile = $this->crowdin->translationMemory->download(4, 1);
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
            'body' => json_encode($params),
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
                "finishedAt": "2019-09-23T11:26:54+00:00"
              }
            }'
        ]);

        $export = $this->crowdin->translationMemory->export(4, $params);
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
                "finishedAt": "2019-09-23T11:26:54+00:00"
              }
            }');

        $export = $this->crowdin->translationMemory->checkExportStatus(4, '50fb3506-4127-4ba8-8296-f97dc7e3e0c3');
        $this->assertInstanceOf(TranslationMemoryExport::class, $export);
        $this->assertEquals('50fb3506-4127-4ba8-8296-f97dc7e3e0c3', $export->getIdentifier());
    }

    public function testImport()
    {
        $expected_body = [
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
        $params = [
            'phraseEn' => 0,
            'phraseDe' => 1,
            'phrasePl' => 2,
            'phraseUk' => 4,
        ];

        $this->mockRequest([
            'path' => '/tms/4/imports',
            'method' => 'post',
            'body' => json_encode($expected_body),
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
                        "finishedAt": "string"
                      }
                    }'
        ]);

        $translationMemoryImport = $this->crowdin->translationMemory->import(4, 0, false, $params);
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
                "finishedAt": "string"
              }
            }');

        $translationMemoryImport = $this->crowdin->translationMemory->checkImportStatus(4, 'b5215a34-1305-4b21-8054-fc2eb252842f');
        $this->assertInstanceOf(TranslationMemoryImport::class, $translationMemoryImport);
        $this->assertEquals('b5215a34-1305-4b21-8054-fc2eb252842f', $translationMemoryImport->getIdentifier());
    }

    public function testClear()
    {
        $this->mockRequestDelete('/tms/4/segments');
        $this->crowdin->translationMemory->clear(4);
    }

    public function testConcordance(): void
    {
        $params = [
            'sourceLanguageId' => 'en',
            'targetLanguageId' => 'de',
            'autoSubstitution' => true,
            'minRelevant' => 60,
            'expressions' => [
                'Welcome!',
                'Save as...',
                'View',
                'About...',
            ],
        ];

        $this->mockRequest([
            'path' => '/projects/4/tms/concordance',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => '{
              "data": [
                {
                  "data": {
                    "tm": {
                      "id": 4,
                      "name": "Knowledge Base TM"
                    },
                    "recordId": 34,
                    "source": "Welcome!",
                    "target": "Ласкаво просимо!",
                    "relevant": 100,
                    "substituted": "62→100",
                    "updatedAt": "2022-09-28T12:29:34+00:00"
                  }
                }
              ],
              "pagination": {
                "offset": 0,
                "limit": 25
              }
            }',
        ]);

        /** @var TranslationMemoryConcordance[] $concordance */
        $concordance = $this->crowdin->translationMemory->concordance(4, $params);

        $this->assertInstanceOf(ModelCollection::class, $concordance);
        $this->assertCount(1, $concordance);
        $this->assertInstanceOf(TranslationMemoryConcordance::class, $concordance[0]);
        $this->assertEquals(4, $concordance[0]->getTm()->getId());
    }
}
