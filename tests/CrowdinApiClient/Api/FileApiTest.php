<?php

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\DownloadFile;
use CrowdinApiClient\Model\File;
use CrowdinApiClient\Model\FileRevision;
use CrowdinApiClient\ModelCollection;

/**
 * Class FileApiTest
 * @package Crowdin\Tests\Api
 */
class FileApiTest extends AbstractTestApi
{
    /**
     * @test
     */
    public function testList()
    {
        $this->mockRequest([
            'path' => '/projects/2/files',
            'method' => 'get',
            'response' => '{
                  "data": [
                    {
                      "data": {
                        "id": 44,
                        "projectId": 2,
                        "branchId": 34,
                        "directoryId": 4,
                        "languageId": "en",
                        "name": "umbrella_app.xliff",
                        "title": "source_app_info",
                        "type": "xliff",
                        "revision": 1,
                        "status": "active",
                        "priority": "normal",
                        "attributes": {
                          "mimeType": "application/xml",
                          "fileSize": 261433
                        },
                        "exportPattern": "string",
                        "createdAt": "2019-09-19T15:10:43+00:00",
                        "updatedAt": "2019-09-19T15:10:46+00:00"
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

        $files = $files = $this->crowdin->file->list(2);

        $this->assertInstanceOf(ModelCollection::class, $files);
        $this->assertCount(1, $files);
        $this->assertInstanceOf(File::class, $files[0]);
        $this->assertEquals(44, $files[0]->getId());
    }

    public function testGetAndEdit()
    {
        $this->mockRequestGet('/projects/2/files/44', '{
              "data": {
                "id": 44,
                "projectId": 2,
                "branchId": 34,
                "directoryId": 4,
                "languageId": "en",
                "name": "umbrella_app.xliff",
                "title": "source_app_info",
                "type": "xliff",
                "revision": 1,
                "status": "active",
                "priority": "normal",
                "attributes": {
                  "mimeType": "application/xml",
                  "fileSize": 261433
                },
                "exportPattern": "string",
                "createdAt": "2019-09-19T15:10:43+00:00",
                "updatedAt": "2019-09-19T15:10:46+00:00"
              }
        }');

        $file = $this->crowdin->file->get(2, 44);

        $this->assertInstanceOf(File::class, $file);
        $this->assertEquals(44, $file->getId());

        $this->assertEquals('source_app_info', $file->getTitle());

        $file->setTitle('source_app_info edit');

        $this->mockRequestPath('/projects/2/files/44', '{
              "data": {
                "id": 44,
                "projectId": 2,
                "branchId": 34,
                "directoryId": 4,
                "languageId": "en",
                "name": "umbrella_app.xliff",
                "title": "source_app_info edit",
                "type": "xliff",
                "revision": 1,
                "status": "active",
                "priority": "normal",
                "attributes": {
                  "mimeType": "application/xml",
                  "fileSize": 261433
                },
                "exportPattern": "string",
                "createdAt": "2019-09-19T15:10:43+00:00",
                "updatedAt": "2019-09-19T15:10:46+00:00"
              }
        }');

        $file = $this->crowdin->file->edit($file);

        $this->assertEquals('source_app_info edit', $file->getTitle());
    }

    public function testUpdate()
    {
        $this->mockRequestPut('/projects/2/files/44', '{
            "data": {
                "id": 44,
                "projectId": 2,
                "branchId": 34,
                "directoryId": 4,
                "languageId": "en",
                "name": "umbrella_app.xliff",
                "title": "source_app_info",
                "type": "xliff",
                "revision": 2,
                "status": "active",
                "priority": "normal",
                "attributes": {
                    "mimeType": "application/xml",
                    "fileSize": 261433
                },
                "exportPattern": "string",
                "createdAt": "2019-09-19T15:10:43+00:00",
                "updatedAt": "2019-09-19T15:10:46+00:00"
            }
        }');

        $file = $this->crowdin->file->update(2, 44, ['storageId' => 1]);

        $this->assertInstanceOf(File::class, $file);
        $this->assertEquals(2, $file->getRevision());
    }

    public function testRestore()
    {
        $this->mockRequestPut('/projects/2/files/44', '{
            "data": {
                "id": 44,
                "projectId": 2,
                "branchId": 34,
                "directoryId": 4,
                "languageId": "en",
                "name": "umbrella_app.xliff",
                "title": "source_app_info",
                "type": "xliff",
                "revision": 19,
                "status": "active",
                "priority": "normal",
                "attributes": {
                    "mimeType": "application/xml",
                    "fileSize": 261433
                },
                "exportPattern": "string",
                "createdAt": "2019-09-19T15:10:43+00:00",
                "updatedAt": "2019-09-19T15:10:46+00:00"
            }
        }');

        $file = $this->crowdin->file->update(2, 44, ['storageId' => 1]);

        $this->assertInstanceOf(File::class, $file);
        $this->assertEquals(19, $file->getRevision());
    }

    public function testCreate()
    {
        $params = [
            'storageId' => 61,
            'name' => 'umbrella_app.xliff',
            'branchId' => 34,
            'directoryId' => 4,
            'title' => 'source_app_info',
            'type' => 'xliff',
            'importOptions' =>
                [
                    'firstLineContainsHeader' => true,
                    'scheme' =>
                        [
                            'identifier' => 0,
                            'sourcePhrase' => 1,
                            'en' => 2,
                            'de' => 3,
                        ],
                ],
            'exportOptions' =>
                [
                    'escapeQuotes' => 3,
                ],
        ];

        $this->mockRequest([
            'path' => '/projects/2/files',
            'method' => 'post',
            'body' => $params,
            'response' => '{
                  "data": {
                    "id": 44,
                    "projectId": 2,
                    "branchId": 34,
                    "directoryId": 4,
                    "languageId": "en",
                    "name": "umbrella_app.xliff",
                    "title": "source_app_info",
                    "type": "xliff",
                    "revision": 1,
                    "status": "active",
                    "priority": "normal",
                    "attributes": {
                      "mimeType": "application/xml",
                      "fileSize": 261433
                    },
                    "exportPattern": "string",
                    "createdAt": "2019-09-19T15:10:43+00:00",
                    "updatedAt": "2019-09-19T15:10:46+00:00"
                  }
                }'
        ]);

        $file = $this->crowdin->file->create(2, $params);
        $this->assertInstanceOf(File::class, $file);
        $this->assertEquals(44, $file->getId());
    }

    public function testDelete()
    {
        $this->mockRequestDelete('/projects/2/files/44');
        $this->crowdin->file->delete(2, 44);
    }

    public function testDownload()
    {
        $this->mockRequestGet('/projects/2/files/44/download', '{
              "data": {
                "url": "https://production-enterprise-importer.downloads.crowdin.com/992000002/2/14.xliff?response-content-disposition=attachment%3B%20filename%3D%22APP.xliff%22&X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAIGJKLQV66ZXPMMEA%2F20190920%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20190920T093121Z&X-Amz-SignedHeaders=host&X-Amz-Expires=3600&X-Amz-Signature=439ebd69a1b7e4c23e6d17891a491c94f832e0c82e4692dedb35a6cd1e624b62",
                "expireIn": "2019-09-20T10:31:21+00:00"
              }
            }');

        $downloadFile = $this->crowdin->file->download(2, 44);
        $this->assertInstanceOf(DownloadFile::class, $downloadFile);
        $this->assertEquals('https://production-enterprise-importer.downloads.crowdin.com/992000002/2/14.xliff?response-content-disposition=attachment%3B%20filename%3D%22APP.xliff%22&X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAIGJKLQV66ZXPMMEA%2F20190920%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20190920T093121Z&X-Amz-SignedHeaders=host&X-Amz-Expires=3600&X-Amz-Signature=439ebd69a1b7e4c23e6d17891a491c94f832e0c82e4692dedb35a6cd1e624b62', $downloadFile->getUrl());
    }

    public function testListRevisions()
    {
        $this->mockRequestGet('/projects/2/files/44/revisions', '{
              "data": [
                {
                  "data": {
                    "id": 16,
                    "projectId": 2,
                    "revision": 2,
                    "revertTo": 0,
                    "translationChunks": 1,
                    "info": {
                      "added": {
                        "strings": 17,
                        "words": 43,
                        "chars": 242,
                        "charsWithSpaces": 268
                      },
                      "deleted": {
                        "strings": 17,
                        "words": 43,
                        "chars": 242,
                        "charsWithSpaces": 268
                      },
                      "changed": {
                        "strings": 17,
                        "words": 43,
                        "chars": 242,
                        "charsWithSpaces": 268
                      },
                      "updated": {
                        "strings": 17,
                        "words": 43,
                        "chars": 242,
                        "charsWithSpaces": 268
                      },
                      "translated": {
                        "strings": 17,
                        "words": 43,
                        "chars": 242,
                        "charsWithSpaces": 268
                      },
                      "approved": {
                        "strings": 17,
                        "words": 43,
                        "chars": 242,
                        "charsWithSpaces": 268
                      },
                      "addedToTranslate": {
                        "strings": 17,
                        "words": 43,
                        "chars": 242,
                        "charsWithSpaces": 268
                      }
                    },
                    "date": "2019-09-20T09:08:16+00:00"
                  }
                }
              ],
              "pagination": [
                {
                  "offset": 0,
                  "limit": 0
                }
              ]
            }');

        $revisions = $this->crowdin->file->revisions(2, 44);
        $this->assertInstanceOf(ModelCollection::class, $revisions);
        $this->assertCount(1, $revisions);
        $this->assertInstanceOf(FileRevision::class, $revisions[0]);
        $this->assertEquals(16, $revisions[0]->getId());
    }

    public function testGetRevision()
    {
        $this->mockRequestGet('/projects/2/files/44/revisions/16', '{
                  "data": {
                    "id": 16,
                    "projectId": 2,
                    "revision": 2,
                    "revertTo": 0,
                    "translationChunks": 1,
                    "info": {
                      "added": {
                        "strings": 17,
                        "words": 43,
                        "chars": 242,
                        "charsWithSpaces": 268
                      },
                      "deleted": {
                        "strings": 17,
                        "words": 43,
                        "chars": 242,
                        "charsWithSpaces": 268
                      },
                      "changed": {
                        "strings": 17,
                        "words": 43,
                        "chars": 242,
                        "charsWithSpaces": 268
                      },
                      "updated": {
                        "strings": 17,
                        "words": 43,
                        "chars": 242,
                        "charsWithSpaces": 268
                      },
                      "translated": {
                        "strings": 17,
                        "words": 43,
                        "chars": 242,
                        "charsWithSpaces": 268
                      },
                      "approved": {
                        "strings": 17,
                        "words": 43,
                        "chars": 242,
                        "charsWithSpaces": 268
                      },
                      "addedToTranslate": {
                        "strings": 17,
                        "words": 43,
                        "chars": 242,
                        "charsWithSpaces": 268
                      }
                    },
                    "date": "2019-09-20T09:08:16+00:00"
                  }
                }');

        $fileRevision = $this->crowdin->file->getRevision(2, 44, 16);

        $this->assertInstanceOf(FileRevision::class, $fileRevision);
        $this->assertEquals(16, $fileRevision->getId());
    }
}
