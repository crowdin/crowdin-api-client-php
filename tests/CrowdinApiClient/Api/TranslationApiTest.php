<?php

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\DownloadFile;
use CrowdinApiClient\Model\PreTranslation;
use CrowdinApiClient\Model\TranslationProjectBuild;
use CrowdinApiClient\ModelCollection;

class TranslationApiTest extends AbstractTestApi
{
    public function testListPreTranslations(): void
    {
        $this->mockRequestGet(
            '/projects/8/pre-translations',
            json_encode([
                'data' => [
                    [
                        'data' => [
                            'identifier' => '55eff5b7-b21e-4620-9cb0-c46e31902af6',
                            'status' => 'in_progress',
                            'progress' => 0,
                            'attributes' => [
                                'method' => 'tm',
                                'fileIds' => [
                                    12,
                                ],
                                'labelIds' => [],
                                'languageIds' => [
                                    'uk',
                                ],
                                'excludeLabelIds' => [],
                                'autoApproveOption' => 'none',
                                'fallbackLanguages' => null,
                                'duplicateTranslations' => false,
                                'skipApprovedTranslations' => false,
                                'translateUntranslatedOnly' => true,
                                'translateWithPerfectMatchOnly' => false,
                            ],
                            'createdAt' => '2025-03-04T15:58:12+00:00',
                            'updatedAt' => '2025-03-04T15:58:57+00:00',
                            'startedAt' => '2025-03-04T15:58:13+00:00',
                            'finishedAt' => null,
                            'eta' => '44 seconds',
                        ],
                    ],
                ],
                'pagination' => [
                    'offset' => 0,
                    'limit' => 25,
                ],
            ])
        );

        $preTranslations = $this->crowdin->translation->listPreTranslations(8);

        $this->assertInstanceOf(ModelCollection::class, $preTranslations);
        $this->assertCount(1, $preTranslations);
        $this->assertSame('55eff5b7-b21e-4620-9cb0-c46e31902af6', $preTranslations[0]->getIdentifier());
    }

    public function testApplyPreTranslation(): void
    {
        $params = [
            'languageIds' => ['uk'],
            'fileIds' => [0],
        ];

        $this->mockRequest([
            'path' => '/projects/2/pre-translations',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => json_encode([
                'data' => [
                    'identifier' => '9e7de270-4f83-41cb-b606-2f90631f26e2',
                    'status' => 'created',
                    'progress' => 90,
                    'attributes' => [
                        'languageIds' => ['uk'],
                        'fileIds' => [0],
                        'method' => 'tm',
                        'autoApproveOption' => 'all',
                        'duplicateTranslations' => true,
                        'translateUntranslatedOnly' => true,
                        'translateWithPerfectMatchOnly' => true,
                        'organizationId' => 200000299,
                        'projectId' => 2,
                        'userId' => 6,
                    ],
                    'createdAt' => '2019-09-20T14:05:50+00:00',
                    'updatedAt' => '2019-09-20T14:05:50+00:00',
                    'startedAt' => '2019-11-13T08:17:22Z',
                    'finishedAt' => '2019-11-13T08:17:22Z',
                ],
            ]),
        ]);

        $preTranslation = $this->crowdin->translation->applyPreTranslation(2, $params);

        $this->assertInstanceOf(PreTranslation::class, $preTranslation);
        $this->assertEquals('9e7de270-4f83-41cb-b606-2f90631f26e2', $preTranslation->getIdentifier());
    }

    public function testGetPreTranslation(): void
    {
        $this->mockRequestGet(
            '/projects/2/pre-translations/9e7de270-4f83-41cb-b606-2f90631f26e2',
            json_encode([
                'data' => [
                    'identifier' => '9e7de270-4f83-41cb-b606-2f90631f26e2',
                    'status' => 'created',
                    'progress' => 90,
                    'attributes' => [
                        'languageIds' => ['uk'],
                        'fileIds' => [0],
                        'method' => 'tm',
                        'autoApproveOption' => 'all',
                        'duplicateTranslations' => true,
                        'translateUntranslatedOnly' => true,
                        'translateWithPerfectMatchOnly' => true,
                        'organizationId' => 200000299,
                        'projectId' => 2,
                        'userId' => 6,
                    ],
                    'createdAt' => '2019-09-20T14:05:50+00:00',
                    'updatedAt' => '2019-09-20T14:05:50+00:00',
                    'startedAt' => '2019-11-13T08:17:22Z',
                    'finishedAt' => '2019-11-13T08:17:22Z',
                ],
            ])
        );

        $preTranslation = $this->crowdin->translation->getPreTranslation(2, '9e7de270-4f83-41cb-b606-2f90631f26e2');

        $this->assertInstanceOf(PreTranslation::class, $preTranslation);
        $this->assertEquals('9e7de270-4f83-41cb-b606-2f90631f26e2', $preTranslation->getIdentifier());
    }

    public function testUpdatePreTranslation(): void
    {
        $this->mockRequest([
            'path' => '/projects/8/pre-translations/9e7de270-4f83-41cb-b606-2f90631f26e2',
            'method' => 'patch',
            'body' => json_encode([
                [
                    'op' => 'replace',
                    'path' => '/status',
                    'value' => 'canceled',
                ]
            ]),
            'response' => json_encode([
                'data' => [
                    'identifier' => '9e7de270-4f83-41cb-b606-2f90631f26e2',
                    'status' => 'canceled',
                    'progress' => 0,
                    'attributes' => [
                        'languageIds' => ['uk'],
                        'fileIds' => [10],
                    ],
                    'createdAt' => '2019-09-20T14:05:50+00:00',
                    'updatedAt' => '2019-09-20T14:05:50+00:00',
                    'startedAt' => '2019-11-13T08:17:22Z',
                    'finishedAt' => '2019-11-13T08:17:22Z',
                ],
            ])
        ]);

        $preTranslation = new PreTranslation([
            'identifier' => '9e7de270-4f83-41cb-b606-2f90631f26e2',
            'status' => 'in_progress',
            'progress' => 90,
            'attributes' => [
                'languageIds' => ['uk'],
                'fileIds' => [10],
            ],
            'createdAt' => '2019-09-20T14:05:50+00:00',
            'updatedAt' => '2019-09-20T14:05:50+00:00',
            'startedAt' => '2019-11-13T08:17:22Z',
            'finishedAt' => '2019-11-13T08:17:22Z',
        ]);
        $preTranslation->setStatus('canceled');

        $actual = $this->crowdin->translation->updatePreTranslation(8, $preTranslation);

        $this->assertInstanceOf(PreTranslation::class, $actual);
        $this->assertSame('canceled', $actual->getStatus());
        $this->assertSame(0, $actual->getProgress());
    }

    public function testBuildProjectFileTranslation(): void
    {
        $this->mockRequest([
            'uri' => 'https://api.crowdin.com/api/v2/projects/1/translations/builds/files/2',
            'method' => 'post',
            'headers' => [
                'content-type' => 'application/json',
                'if-none-match' => 'bfc13a64729c4290ef5b2c2730249c88ca92d82d',
                'Authorization' => 'Bearer access_token',
            ],
            'response' => json_encode([
                'data' => [
                    'url' => 'https://foo.com/file',
                    'expireIn' => '2019-09-20T10:31:21+00:00',
                ],
            ]),
        ]);

        $file = $this->crowdin->translation->buildProjectFileTranslation(
            1,
            2,
            ['targetLanguageId' => 'uk'],
            'bfc13a64729c4290ef5b2c2730249c88ca92d82d'
        );

        $this->assertInstanceOf(DownloadFile::class, $file);
        $this->assertEquals('https://foo.com/file', $file->getUrl());
    }

    public function testListProjectBuilds(): void
    {
        $this->mockRequestGet(
            '/projects/2/translations/builds',
            json_encode([
                'data' => [
                    [
                        'data' => [
                            'id' => 2,
                            'projectId' => 2,
                            'branchId' => 34,
                            'languagesId' => [15],
                            'status' => 'finished',
                            'progress' => [
                                'percent' => 90,
                                'currentLanguageId' => 'uk',
                                'currentFileId' => 1,
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
            ])
        );

        $translationProjectBuilds = $this->crowdin->translation->getProjectBuilds(2);

        $this->assertInstanceOf(ModelCollection::class, $translationProjectBuilds);
        $this->assertCount(1, $translationProjectBuilds);
        $this->assertInstanceOf(TranslationProjectBuild::class, $translationProjectBuilds[0]);
        $this->assertEquals(2, $translationProjectBuilds[0]->getId());
    }

    public function testBuildProject(): void
    {
        $this->mockRequest([
            'uri' => 'https://api.crowdin.com/api/v2/projects/2/translations/builds',
            'method' => 'post',
            'response' => json_encode([
                'data' => [
                    'id' => 2,
                    'projectId' => 2,
                    'branchId' => 34,
                    'languagesId' => [15],
                    'status' => 'finished',
                    'progress' => [
                        'percent' => 90,
                        'currentLanguageId' => 'uk',
                        'currentFileId' => 1,
                    ],
                ],
            ]),
            'options' => [
                'body' => [
                    'branchId' => 2,
                    'targetLanguageIds' => ['uk'],
                ],
            ],
        ]);

        $params = [
            'branchId' => 2,
            'targetLanguageIds' =>
                [
                    0 => 'uk',
                ],
            'skipUntranslatedStrings' => false,
            'skipUntranslatedFiles' => false,
            'exportApprovedOnly' => false,
        ];

        $projectBuild = $this->crowdin->translation->buildProject(2, $params);

        $this->assertInstanceOf(TranslationProjectBuild::class, $projectBuild);
        $this->assertEquals(2, $projectBuild->getId());
    }

    public function testGetProjectBuildStatus(): void
    {
        $this->mockRequestGet(
            '/projects/2/translations/builds/2',
            json_encode([
                'data' => [
                    'id' => 2,
                    'projectId' => 2,
                    'branchId' => 34,
                    'languagesId' => [15],
                    'status' => 'finished',
                    'progress' => [
                        'percent' => 90,
                        'currentLanguageId' => 'uk',
                        'currentFileId' => 1,
                    ],
                ],
            ])
        );

        $projectBuild = $this->crowdin->translation->getProjectBuildStatus(2, 2);

        $this->assertInstanceOf(TranslationProjectBuild::class, $projectBuild);
        $this->assertEquals(2, $projectBuild->getId());
    }

    public function testDownloadProjectBuild(): void
    {
        $this->mockRequestGet(
            '/projects/2/translations/builds/2/download',
            json_encode([
                'data' => [
                    'url' => 'https://production-enterprise-importer.downloads.crowdin.com/992000002/2/14.xliff',
                    'expireIn' => '2019-09-20T10:31:21+00:00',
                ],
            ])
        );

        $file = $this->crowdin->translation->downloadProjectBuild(2, 2);

        $this->assertInstanceOf(DownloadFile::class, $file);
        $this->assertEquals(
            'https://production-enterprise-importer.downloads.crowdin.com/992000002/2/14.xliff',
            $file->getUrl()
        );
    }

    public function testDeleteProjectBuild(): void
    {
        $this->mockRequest([
            'path' => '/projects/2/translations/builds/2',
            'method' => 'delete',
        ]);

        $this->crowdin->translation->deleteProjectBuild(2, 2);
    }

    public function testUploadTranslations(): void
    {
        $params = [
            'storageId' => 13,
            'fileId' => 2,
        ];

        $this->mockRequest([
            'path' => '/projects/8/translations/uk',
            'method' => 'post',
            'response' => json_encode([
                'data' => [
                    'projectId' => 8,
                    'storageId' => 34,
                    'languageId' => 'uk',
                    'fileId' => 56,
                ],
            ]),
            'options' => [
                'body' => [
                    'storageId' => 13,
                    'fileId' => 2,
                ],
            ],
        ]);

        $data = $this->crowdin->translation->uploadTranslations(8, 'uk', $params);

        $this->assertIsArray($data);
        $this->assertEquals([
            'projectId' => 8,
            'storageId' => 34,
            'languageId' => 'uk',
            'fileId' => 56,
        ], $data);
    }

    public function testExportProjectTranslation(): void
    {
        $params = [
            'targetLanguageId' => 'en',
            'fileIds' => [7, 14, 15],
        ];

        $this->mockRequest(
            [
                'path' => '/projects/2/translations/exports',
                'method' => 'post',
                'response' => json_encode([
                    'data' => [
                        'url' => 'https://production-enterprise-importer.downloads.crowdin.com/992000002/2/14.xliff',
                        'expireIn' => '2019-09-20T10:31:21+00:00',
                    ],
                ]),
            ]
        );

        $file = $this->crowdin->translation->exportProjectTranslation(2, $params);

        $this->assertInstanceOf(DownloadFile::class, $file);
        $this->assertEquals(
            'https://production-enterprise-importer.downloads.crowdin.com/992000002/2/14.xliff',
            $file->getUrl()
        );
    }
}
