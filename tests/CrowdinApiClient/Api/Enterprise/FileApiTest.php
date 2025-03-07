<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Api\Enterprise;

use CrowdinApiClient\Model\DownloadFile;
use CrowdinApiClient\Model\Enterprise\ReviewedSourceFileBuild;
use CrowdinApiClient\ModelCollection;

class FileApiTest extends AbstractTestApi
{
    public function testBuildReviewedSourceFiles(): void
    {
        $params = [
            'branchId' => 3,
        ];

        $this->mockRequest([
            'path' => '/projects/2/strings/reviewed-builds',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => json_encode([
                'data' => [
                    'id' => 44,
                    'projectId' => 2,
                    'status' => 'created',
                    'progress' => 0,
                    'attributes' => [
                        'branchId' => 3,
                        'targetLanguageId' => 'en',
                    ],
                ],
            ]),
        ]);

        $reviewedSourceFileBuild = $this->crowdin->file->buildReviewedSourceFiles(2, $params);

        $this->assertInstanceOf(ReviewedSourceFileBuild::class, $reviewedSourceFileBuild);
        $this->assertEquals(44, $reviewedSourceFileBuild->getId());
        $this->assertEquals("created", $reviewedSourceFileBuild->getStatus());
    }

    public function testCheckReviewedSourceFilesBuildStatus(): void
    {
        $this->mockRequestGet(
            '/projects/2/strings/reviewed-builds/44',
            json_encode([
                'data' => [
                    'id' => 44,
                    'projectId' => 2,
                    'status' => 'finished',
                    'progress' => 100,
                    'attributes' => [
                        'branchId' => 3,
                        'targetLanguageId' => 'en',
                    ],
                ],
            ])
        );

        $reviewedSourceFileBuild = $this->crowdin->file->checkReviewedSourceFilesBuildStatus(2, 44);

        $this->assertInstanceOf(ReviewedSourceFileBuild::class, $reviewedSourceFileBuild);
        $this->assertEquals(44, $reviewedSourceFileBuild->getId());
        $this->assertEquals("finished", $reviewedSourceFileBuild->getStatus());
        $this->assertEquals(100, $reviewedSourceFileBuild->getProgress());
    }

    public function testListReviewedSourceFilesBuilds(): void
    {
        $this->mockRequest([
            'path' => '/projects/2/strings/reviewed-builds',
            'method' => 'get',
            'response' => json_encode([
                'data' => [
                    [
                        'data' => [
                            'id' => 44,
                            'projectId' => 2,
                            'status' => 'finished',
                            'progress' => 100,
                            'attributes' => [
                                'branchId' => 3,
                                'targetLanguageId' => 'en',
                            ],
                        ],
                    ],
                ],
                'pagination' => [
                    [
                        'offset' => 0,
                        'limit' => 0,
                    ],
                ],
            ]),
        ]);

        $reviewedSourceBuilds = $this->crowdin->file->listReviewedSourceFilesBuilds(2);

        $this->assertInstanceOf(ModelCollection::class, $reviewedSourceBuilds);
        $this->assertCount(1, $reviewedSourceBuilds);
        $this->assertInstanceOf(ReviewedSourceFileBuild::class, $reviewedSourceBuilds[0]);
        $this->assertEquals(44, $reviewedSourceBuilds[0]->getId());
        $this->assertEquals(100, $reviewedSourceBuilds[0]->getProgress());
    }

    public function testDownloadReviewedSourceFiles(): void
    {
        $this->mockRequestGet(
            '/projects/2/strings/reviewed-builds/44/download',
            json_encode([
                'data' => [
                    'url' => 'https://production-enterprise-importer.downloads.crowdin.com/992000002/2/14.xliff',
                    'expireIn' => '2019-09-20T10:31:21+00:00',
                ],
            ])
        );

        $downloadFile = $this->crowdin->file->downloadReviewedSourceFiles(2, 44);

        $this->assertInstanceOf(DownloadFile::class, $downloadFile);
        $this->assertEquals(
            'https://production-enterprise-importer.downloads.crowdin.com/992000002/2/14.xliff',
            $downloadFile->getUrl()
        );
    }
}
