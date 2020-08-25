<?php

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\DownloadFile;
use CrowdinApiClient\Model\PreTranslation;
use CrowdinApiClient\Model\TranslationProjectBuild;
use CrowdinApiClient\ModelCollection;

/**
 * Class TranslationApiTest
 * @package Crowdin\Tests\Api
 */
class TranslationApiTest extends AbstractTestApi
{
    public function testApplyPreTranslation()
    {
        $params = [
            'languageIds' => ['uk'],
            'fileIds' => [0]
        ];

        $this->mockRequest([
            'path' => '/projects/2/pre-translations',
            'method' => 'post',
            'body' => $params,
            'response' => '{
                  "data": {
                    "identifier": "9e7de270-4f83-41cb-b606-2f90631f26e2",
                    "status": "created",
                    "progress": 90,
                    "attributes": {
                      "languageIds": [
                        "uk"
                      ],
                      "fileIds": [
                        0
                      ],
                      "method": "tm",
                      "autoApproveOption": "all",
                      "duplicateTranslations": true,
                      "translateUntranslatedOnly": true,
                      "translateWithPerfectMatchOnly": true,
                      "organizationId": 200000299,
                      "projectId": 2,
                      "userId": 6
                    },
                    "createdAt": "2019-09-20T14:05:50+00:00",
                    "updatedAt": "2019-09-20T14:05:50+00:00",
                    "startedAt": "2019-11-13T08:17:22Z",
                    "finishedAt": "2019-11-13T08:17:22Z",
                    "eta": "10 seconds"
                  }
                }'
        ]);

        $preTranslation = $this->crowdin->translation->applyPreTranslation(2, $params);
        $this->assertInstanceOf(PreTranslation::class, $preTranslation);
        $this->assertEquals('9e7de270-4f83-41cb-b606-2f90631f26e2', $preTranslation->getIdentifier());
    }

    public function testGetPreTranslation()
    {
        $this->mockRequestGet('/projects/2/pre-translations/9e7de270-4f83-41cb-b606-2f90631f26e2', '{
              "data": {
                "identifier": "9e7de270-4f83-41cb-b606-2f90631f26e2",
                "status": "created",
                "progress": 90,
                "attributes": {
                  "languageIds": [
                    "uk"
                  ],
                  "fileIds": [
                    0
                  ],
                  "method": "tm",
                  "autoApproveOption": "all",
                  "duplicateTranslations": true,
                  "translateUntranslatedOnly": true,
                  "translateWithPerfectMatchOnly": true,
                  "organizationId": 200000299,
                  "projectId": 2,
                  "userId": 6
                },
                "createdAt": "2019-09-20T14:05:50+00:00",
                "updatedAt": "2019-09-20T14:05:50+00:00",
                "startedAt": "2019-11-13T08:17:22Z",
                "finishedAt": "2019-11-13T08:17:22Z",
                "eta": "10 seconds"
              }
            }');

        $preTranslation = $this->crowdin->translation->getPreTranslation(2, '9e7de270-4f83-41cb-b606-2f90631f26e2');

        $this->assertInstanceOf(PreTranslation::class, $preTranslation);
        $this->assertEquals('9e7de270-4f83-41cb-b606-2f90631f26e2', $preTranslation->getIdentifier());
    }

    public function testBuildProjectFileTranslation()
    {
        $this->mockRequest([
            'uri' => 'https://api.crowdin.com/api/v2/projects/1/translations/builds/files/2',
            'method' => 'post',
            'response' => '{
              "data": {
                "url": "https://foo.com/file",
                "expireIn": "2019-09-20T10:31:21+00:00"
              }
            }'
        ]);

        $file = $this->crowdin->translation->buildProjectFileTranslation(1, 2, 'uk', false);

        $this->assertInstanceOf(DownloadFile::class, $file);
        $this->assertEquals('https://foo.com/file', $file->getUrl());
    }

    public function testListProjectBuilds()
    {
        $this->mockRequestGet('/projects/2/translations/builds', '{
          "data": [
            {
              "data": {
                "id": 2,
                "projectId": 2,
                "branchId": 34,
                "languagesId": [
                  15
                ],
                "status": "finished",
                "progress": {
                  "percent": 90,
                  "currentLanguageId": "uk",
                  "currentFileId": 1
                }
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

        $translationProjectBuilds = $this->crowdin->translation->getProjectBuilds(2);
        $this->assertInstanceOf(ModelCollection::class, $translationProjectBuilds);
        $this->assertCount(1, $translationProjectBuilds);
        $this->assertInstanceOf(TranslationProjectBuild::class, $translationProjectBuilds[0]);
        $this->assertEquals(2, $translationProjectBuilds[0]->getId());
    }

    public function testBuildProject()
    {
        $this->mockRequest([
            'uri' => 'https://api.crowdin.com/api/v2/projects/2/translations/builds',
            'method' => 'post',
            'response' => '{
              "data": {
                "id": 2,
                "projectId": 2,
                "branchId": 34,
                "languagesId": [
                  15
                ],
                "status": "finished",
                "progress": {
                  "percent": 90,
                  "currentLanguageId": "uk",
                  "currentFileId": 1
                }
              }
            }',
            'options' => [
                'body' => [
                    'branchId' => 2,
                    'targetLanguageIds' => ['uk']
                ]
            ]
        ]);

        $params = [
            'branchId' => 2,
            'targetLanguageIds' =>
                [
                    0 => 'uk',
                ],
            'exportApprovedOnly' => false,
        ];

        $projectBuild = $this->crowdin->translation->buildProject(2, $params);

        $this->assertInstanceOf(TranslationProjectBuild::class, $projectBuild);
        $this->assertEquals(2, $projectBuild->getId());
    }

    public function testGetProjectBuildStatus()
    {
        $this->mockRequestGet('/projects/2/translations/builds/2', '{
              "data": {
                "id": 2,
                "projectId": 2,
                "branchId": 34,
                "languagesId": [
                  15
                ],
                "status": "finished",
                "progress": {
                  "percent": 90,
                  "currentLanguageId": "uk",
                  "currentFileId": 1
                }
              }
        }');

        $projectBuild = $this->crowdin->translation->getProjectBuildStatus(2, 2);

        $this->assertInstanceOf(TranslationProjectBuild::class, $projectBuild);
        $this->assertEquals(2, $projectBuild->getId());
    }

    public function testDownloadProjectBuild()
    {
        $this->mockRequestGet('/projects/2/translations/builds/2/download', '{
          "data": {
            "url": "https://production-enterprise-importer.downloads.crowdin.com/992000002/2/14.xliff?response-content-disposition=attachment%3B%20filename%3D%22APP.xliff%22&X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAIGJKLQV66ZXPMMEA%2F20190920%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20190920T093121Z&X-Amz-SignedHeaders=host&X-Amz-Expires=3600&X-Amz-Signature=439ebd69a1b7e4c23e6d17891a491c94f832e0c82e4692dedb35a6cd1e624b62",
            "expireIn": "2019-09-20T10:31:21+00:00"
          }
        }');

        $file = $this->crowdin->translation->downloadProjectBuild(2, 2);
        $this->assertInstanceOf(DownloadFile::class, $file);
        $this->assertEquals('https://production-enterprise-importer.downloads.crowdin.com/992000002/2/14.xliff?response-content-disposition=attachment%3B%20filename%3D%22APP.xliff%22&X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAIGJKLQV66ZXPMMEA%2F20190920%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20190920T093121Z&X-Amz-SignedHeaders=host&X-Amz-Expires=3600&X-Amz-Signature=439ebd69a1b7e4c23e6d17891a491c94f832e0c82e4692dedb35a6cd1e624b62', $file->getUrl());
    }

    public function testDeleteProjectBuild()
    {
        $this->mockRequest([
            'path' => '/projects/2/translations/builds/2',
            'method' => 'delete',
        ]);

        $this->crowdin->translation->deleteProjectBuild(2, 2);
    }

    public function testUploadTranslations()
    {
        $params = [
            'storageId' => 13,
            'fileId' => 2,
        ];

        $this->mockRequest([
            'path' => '/projects/8/translations/uk',
            'method' => 'post',
            'response' => '{
              "data": {
                "projectId": 8,
                "storageId": 34,
                "languageId": "uk",
                "fileId": 56
              }
            }',
            'options' => [
                'body' => [
                    'storageId' => 13,
                    'fileId' => 2,
                ]
            ]
        ]);

        $data = $this->crowdin->translation->uploadTranslations(8, 'uk', $params);

        $this->assertIsArray($data);

        $this->assertEquals([
            'projectId' => 8,
            'storageId' => 34,
            'languageId' => 'uk',
            'fileId' => 56
        ], $data);
    }
}
