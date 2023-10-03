<?php

declare(strict_types=1);

namespace CrowdinApiClient\Api\Enterprise;

use CrowdinApiClient\Model\DownloadFile;
use CrowdinApiClient\Model\Enterprise\ReviewedSourceFileBuild;
use CrowdinApiClient\ModelCollection;
use CrowdinApiClient\Tests\Api\Enterprise\AbstractTestApi;

class FileApiTest extends AbstractTestApi
{
    public function testBuildReviewedSourceFiles()
    {
        $params = [
            'branchId' => 3
        ];

        $this->mockRequest([
            'path' => '/projects/2/strings/reviewed-builds',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => '{
                  "data": {
                    "id": 44,
                    "projectId": 2,
                    "status": "created",
                    "progress":0,
                    "attributes": {
                        "branchId": 3,
                        "targetLanguageId": "en"
                    }
                  }
                }'
        ]);

        $reviewedSourceFileBuild = $this->crowdin->file->buildReviewedSourceFiles(2, $params);
        $this->assertInstanceOf(ReviewedSourceFileBuild::class, $reviewedSourceFileBuild);
        $this->assertEquals(44, $reviewedSourceFileBuild->getId());
        $this->assertEquals("created", $reviewedSourceFileBuild->getStatus());
    }

    public function testCheckReviewedSourceFilesBuildStatus()
    {
        $this->mockRequestGet('/projects/2/strings/reviewed-builds/44', '{
              "data": {
                    "id": 44,
                    "projectId": 2,
                    "status": "finished",
                    "progress":100,
                    "attributes": {
                        "branchId": 3,
                        "targetLanguageId": "en"
                    }
              }
        }');

        $reviewedSourceFileBuild = $this->crowdin->file->checkReviewedSourceFilesBuildStatus(2, 44);

        $this->assertInstanceOf(ReviewedSourceFileBuild::class, $reviewedSourceFileBuild);
        $this->assertEquals(44, $reviewedSourceFileBuild->getId());
        $this->assertEquals("finished", $reviewedSourceFileBuild->getStatus());
        $this->assertEquals(100, $reviewedSourceFileBuild->getProgress());
    }

    public function testListReviewedSourceFilesBuilds()
    {
        $this->mockRequest([
            'path' => '/projects/2/strings/reviewed-builds',
            'method' => 'get',
            'response' => '{
                  "data": [
                    {
                      "data": {
                        "id": 44,
                        "projectId": 2,
                        "status": "finished",
                        "progress":100,
                        "attributes": {
                            "branchId": 3,
                            "targetLanguageId": "en"
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
                }'
        ]);

        $reviewedSourceBuilds = $reviewedSourceBuilds = $this->crowdin->file->listReviewedSourceFilesBuilds(2);

        $this->assertInstanceOf(ModelCollection::class, $reviewedSourceBuilds);
        $this->assertCount(1, $reviewedSourceBuilds);
        $this->assertInstanceOf(ReviewedSourceFileBuild::class, $reviewedSourceBuilds[0]);
        $this->assertEquals(44, $reviewedSourceBuilds[0]->getId());
        $this->assertEquals(100, $reviewedSourceBuilds[0]->getProgress());
    }

    public function testDownloadReviewedSourceFiles()
    {
        $this->mockRequestGet('/projects/2/strings/reviewed-builds/44/download', '{
              "data": {
                "url": "https://production-enterprise-importer.downloads.crowdin.com/992000002/2/14.xliff?response-content-disposition=attachment%3B%20filename%3D%22APP.xliff%22&X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAIGJKLQV66ZXPMMEA%2F20190920%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20190920T093121Z&X-Amz-SignedHeaders=host&X-Amz-Expires=3600&X-Amz-Signature=439ebd69a1b7e4c23e6d17891a491c94f832e0c82e4692dedb35a6cd1e624b62",
                "expireIn": "2019-09-20T10:31:21+00:00"
              }
            }');

        $downloadFile = $this->crowdin->file->downloadReviewedSourceFiles(2, 44);
        $this->assertInstanceOf(DownloadFile::class, $downloadFile);
        $this->assertEquals('https://production-enterprise-importer.downloads.crowdin.com/992000002/2/14.xliff?response-content-disposition=attachment%3B%20filename%3D%22APP.xliff%22&X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAIGJKLQV66ZXPMMEA%2F20190920%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20190920T093121Z&X-Amz-SignedHeaders=host&X-Amz-Expires=3600&X-Amz-Signature=439ebd69a1b7e4c23e6d17891a491c94f832e0c82e4692dedb35a6cd1e624b62', $downloadFile->getUrl());
    }
}
