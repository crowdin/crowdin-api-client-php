<?php

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\Bundle;
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
            'body' => $params,
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

        $this->mockRequestPath('/projects/2/bundles/34', '{
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
}
