<?php

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\Bundle;
use CrowdinApiClient\Model\BundleExport;
use CrowdinApiClient\Model\DownloadFile;
use CrowdinApiClient\Model\File;
use CrowdinApiClient\ModelCollection;

class BundleApiTest extends AbstractTestApi
{
    public function testList()
    {
        $this->mockRequest([
            'path' => '/projects/2/bundles',
            'method' => 'get',
            'response' => '{
              "data": [
                {
                  "data": {
                    "id": 1,
                    "name": "Resx bundle",
                    "format": "crowdin-resx",
                    "sourcePatterns": [
                      "/master/"
                    ],
                    "ignorePatterns": [
                      "/master/environments/"
                    ],
                    "exportPattern": "strings-%two_letters_code%.resx",
                    "labelIds": [
                      0
                    ],
                    "createdAt": "2019-09-20T11:11:05+00:00",
                    "updatedAt": "2019-09-20T12:22:20+00:00"
                  }
                }
              ],
              "pagination": {
                "offset": 0,
                "limit": 25
              }
            }'
        ]);

        $bundles = $this->crowdin->bundle->list(2);

        $this->assertInstanceOf(ModelCollection::class, $bundles);
        $this->assertCount(1, $bundles);
        $this->assertInstanceOf(Bundle::class, $bundles[0]);
        $this->assertEquals(1, $bundles[0]->getId());
    }

    public function testGet()
    {
        $this->mockRequestGet('/projects/2/bundles/1',
            '{
                  "data": {
                    "id": 1,
                    "name": "Resx bundle",
                    "format": "crowdin-resx",
                    "sourcePatterns": [
                      "/master/"
                    ],
                    "ignorePatterns": [
                      "/master/environments/"
                    ],
                    "exportPattern": "strings-%two_letters_code%.resx",
                    "labelIds": [
                      0
                    ],
                    "createdAt": "2019-09-20T11:11:05+00:00",
                    "updatedAt": "2019-09-20T12:22:20+00:00"
                  }
        }');

        $bundle = $this->crowdin->bundle->get(2, 1);

        $this->assertInstanceOf(Bundle::class, $bundle);
        $this->assertEquals(1, $bundle->getId());
        $this->assertEquals('Resx bundle', $bundle->getName());
    }

    public function testCreate()
    {
        $params = [
            'name' => 'Resx bundle',
            'format' => 'crowdin-resx',
            'sourcePatterns' => ['/master/'],
            'ignorePatterns' => ['/master/environments/'],
            'exportPattern' => 'strings-%two_letters_code%.resx',
            'labelIds' => [0]
        ];

        $this->mockRequest([
            'path' => '/projects/2/bundles',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => '{
                  "data": {
                    "id": 34,
                    "name": "Resx bundle",
                    "format": "crowdin-resx",
                    "sourcePatterns": [
                      "/master/"
                    ],
                    "ignorePatterns": [
                      "/master/environments/"
                    ],
                    "exportPattern": "strings-%two_letters_code%.resx",
                    "labelIds": [
                      0
                    ],
                    "createdAt": "2019-09-20T11:11:05+00:00",
                    "updatedAt": "2019-09-20T12:22:20+00:00"
                  }
                }'
        ]);

        $bundle = $this->crowdin->bundle->create(2, $params);
        $this->assertInstanceOf(Bundle::class, $bundle);
        $this->assertEquals(34, $bundle->getId());
    }

    public function testGetAndUpdate()
    {
        $this->mockRequestGet('/projects/2/bundles/34', '{
                  "data": {
                    "id": 34,
                    "name": "Resx bundle",
                    "format": "crowdin-resx",
                    "sourcePatterns": [
                      "/master/"
                    ],
                    "ignorePatterns": [
                      "/master/environments/"
                    ],
                    "exportPattern": "strings-%two_letters_code%.resx",
                    "labelIds": [
                      0
                    ],
                    "createdAt": "2019-09-20T11:11:05+00:00",
                    "updatedAt": "2019-09-20T12:22:20+00:00"
                  }
            }');

        $bundle = $this->crowdin->bundle->get(2, 34);

        $this->assertInstanceOf(Bundle::class, $bundle);
        $this->assertEquals(34, $bundle->getId());

        $bundle->setName('edit test');

        $this->mockRequestPatch('/projects/2/bundles/34', '{
                  "data": {
                    "id": 34,
                    "name": "edit test",
                    "format": "crowdin-resx",
                    "sourcePatterns": [
                      "/master/"
                    ],
                    "ignorePatterns": [
                      "/master/environments/"
                    ],
                    "exportPattern": "strings-%two_letters_code%.resx",
                    "labelIds": [
                      0
                    ],
                    "createdAt": "2019-09-20T11:11:05+00:00",
                    "updatedAt": "2019-09-20T12:22:20+00:00"
                  }
            }');

        $this->crowdin->bundle->update(2, $bundle);
        $this->assertInstanceOf(Bundle::class, $bundle);
        $this->assertEquals(34, $bundle->getId());
        $this->assertEquals('edit test', $bundle->getName());
    }

    public function testDelete()
    {
        $this->mockRequestDelete('/projects/2/bundles/34');
        $this->crowdin->bundle->delete(2, 34);
    }

    public function testListFiles()
    {
        $this->mockRequest([
            'path' => '/projects/2/bundles/34/files',
            'method' => 'get',
            'response' => '{
              "data": [
                {
                  "data": {
                    "id": 44,
                    "projectId": 2,
                    "branchId": 34,
                    "directoryId": 4,
                    "name": "umbrella_app.xliff",
                    "title": "source_app_info",
                    "type": "xliff",
                    "path": "/directory1/directory2/filename.extension",
                    "status": "active",
                    "revisionId": 1,
                    "priority": "normal",
                    "importOptions": {
                      "firstLineContainsHeader": false,
                      "importTranslations": true,
                      "scheme": {
                        "identifier": 0,
                        "sourcePhrase": 1,
                        "en": 2,
                        "de": 3
                      }
                    },
                    "exportOptions": {
                      "exportPattern": "/localization/%locale%/%file_name%.%file_extension%"
                    },
                    "excludedTargetLanguages": [
                      "es",
                      "pl"
                    ],
                    "createdAt": "2019-09-19T15:10:43+00:00",
                    "updatedAt": "2019-09-19T15:10:46+00:00"
                  }
                }
              ],
              "pagination": {
                "offset": 0,
                "limit": 25
              }
            }'
        ]);

        $files = $this->crowdin->bundle->listFiles(2, 34);
        $this->assertInstanceOf(ModelCollection::class, $files);
        $this->assertCount(1, $files);
        $this->assertInstanceOf(File::class, $files[0]);
        $this->assertEquals(44, $files[0]->getId());
    }

    public function testExport()
    {
        $params = [];

        $this->mockRequest([
            'path' => '/projects/1/bundles/2/exports',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => '{
              "data": {
                "identifier": "50fb3506-4127-4ba8-8296-f97dc7e3e0c3",
                "status": "finished",
                "progress": 10,
                "attributes": {
                  "bundleId": 2
                },
                "createdAt": "2023-09-11T11:26:54+00:00",
                "updatedAt": "2023-09-11T11:26:54+00:00",
                "startedAt": "2023-09-11T11:26:54+00:00",
                "finishedAt": "2023-09-11T11:26:54+00:00"
              }
            }'
        ]);

        $export = $this->crowdin->bundle->export(1, 2);

        $this->assertInstanceOf(BundleExport::class, $export);
        $this->assertEquals('50fb3506-4127-4ba8-8296-f97dc7e3e0c3', $export->getIdentifier());
        $this->assertEquals('2023-09-11T11:26:54+00:00', $export->getCreatedAt());
        $this->assertEquals('2023-09-11T11:26:54+00:00', $export->getStartedAt());
        $this->assertEquals(['bundleId' => 2], $export->getAttributes());
    }

    public function testCheckExportStatus()
    {
        $this->mockRequestGet('/projects/1/bundles/21/exports/50fb3506-4127-4ba8-8296-f97dc7e3e0c3', '{
              "data": {
                "identifier": "50fb3506-4127-4ba8-8296-f97dc7e3e0c3",
                "status": "finished",
                "progress": 100,
                "attributes": {
                  "bundleId": 21
                },
                "createdAt": "2023-09-11T11:26:54+00:00",
                "updatedAt": "2023-09-11T11:26:54+00:00",
                "startedAt": "2023-09-11T11:26:54+00:00",
                "finishedAt": "2023-09-11T11:26:54+00:00"
              }
            }');

        $export = $this->crowdin->bundle->checkExportStatus(1, 21, '50fb3506-4127-4ba8-8296-f97dc7e3e0c3');

        $this->assertInstanceOf(BundleExport::class, $export);
        $this->assertEquals('50fb3506-4127-4ba8-8296-f97dc7e3e0c3', $export->getIdentifier());
        $this->assertEquals('finished', $export->getStatus());
        $this->assertEquals(100, $export->getProgress());
        $this->assertEquals('2023-09-11T11:26:54+00:00', $export->getUpdatedAt());
        $this->assertEquals('2023-09-11T11:26:54+00:00', $export->getFinishedAt());
    }

    public function testDownload()
    {
        $this->mockRequestGet('/projects/1/bundles/21/exports/50fb3506-4127-4ba8-8296-f97dc7e3e0c3/download', '{
          "data": {
            "url": "https://production-enterprise-importer.downloads.crowdin.com/992000002/2/14.xliff?response-content-disposition=attachment%253B%2520filename%253D%2522APP.xliff%2522&X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAIGJKLQV66ZXPMMEA%252F20190920%252Fus-east-1%252Fs3%252Faws4_request&X-Amz-Date=20190920T093121Z&X-Amz-SignedHeaders=host&X-Amz-Expires=3600&X-Amz-Signature=439ebd69a1b7e4c23e6d17891a491c94f832e0c82e4692dedb35a6cd1e624b62",
            "expireIn": "2023-09-11T12:26:54+00:00"
          }
        }');

        $downloadFile = $this->crowdin->bundle->download(1, 21, '50fb3506-4127-4ba8-8296-f97dc7e3e0c3');

        $this->assertInstanceOf(DownloadFile::class, $downloadFile);
        $this->assertEquals('https://production-enterprise-importer.downloads.crowdin.com/992000002/2/14.xliff?response-content-disposition=attachment%253B%2520filename%253D%2522APP.xliff%2522&X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAIGJKLQV66ZXPMMEA%252F20190920%252Fus-east-1%252Fs3%252Faws4_request&X-Amz-Date=20190920T093121Z&X-Amz-SignedHeaders=host&X-Amz-Expires=3600&X-Amz-Signature=439ebd69a1b7e4c23e6d17891a491c94f832e0c82e4692dedb35a6cd1e624b62', $downloadFile->getUrl());
    }
}
