<?php

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\DownloadFile;
use CrowdinApiClient\Model\DownloadFilePreview;
use CrowdinApiClient\Model\File;
use CrowdinApiClient\Model\FileRevision;
use CrowdinApiClient\ModelCollection;

class FileApiTest extends AbstractTestApi
{
    public function testList(): void
    {
        $this->mockRequest([
            'path' => '/projects/2/files',
            'method' => 'get',
            'response' => json_encode([
                'data' => [
                    [
                        'data' => [
                            'id' => 44,
                            'projectId' => 2,
                            'branchId' => 34,
                            'directoryId' => 4,
                            'name' => 'umbrella_app.xliff',
                            'title' => 'source_app_info',
                            'type' => 'xliff',
                            'path' => '/directory1/directory2/filename.extension',
                            'status' => 'active',
                            'revisionId' => 1,
                            'priority' => 'normal',
                            'importOptions' => [
                                'firstLineContainsHeader' => false,
                                'importTranslations' => true,
                                'scheme' => [
                                    'identifier' => 0,
                                    'sourcePhrase' => 1,
                                    'en' => 2,
                                    'de' => 3,
                                ],
                            ],
                            'exportOptions' => [
                                'exportPattern' => '/localization/%locale%/%file_name%.%file_extension%',
                            ],
                            'excludedTargetLanguages' => ['es', 'pl'],
                            'createdAt' => '2019-09-19T15:10:43+00:00',
                            'updatedAt' => '2019-09-19T15:10:46+00:00',
                        ],
                    ],
                ],
                'pagination' => [
                    'offset' => 0,
                    'limit' => 25,
                ],
            ]),
        ]);

        $files = $this->crowdin->file->list(2);

        $this->assertInstanceOf(ModelCollection::class, $files);
        $this->assertCount(1, $files);
        $this->assertInstanceOf(File::class, $files[0]);
        $this->assertEquals(44, $files[0]->getId());
    }

    public function testGetAndEdit(): void
    {
        $this->mockRequestGet(
            '/projects/2/files/44',
            json_encode([
                'data' => [
                    'id' => 44,
                    'projectId' => 2,
                    'branchId' => 34,
                    'directoryId' => 4,
                    'name' => 'umbrella_app.xliff',
                    'title' => 'source_app_info',
                    'type' => 'xliff',
                    'path' => '/directory1/directory2/filename.extension',
                    'status' => 'active',
                    'revisionId' => 1,
                    'priority' => 'normal',
                    'importOptions' => [
                        'firstLineContainsHeader' => false,
                        'importTranslations' => true,
                        'scheme' => [
                            'identifier' => 0,
                            'sourcePhrase' => 1,
                            'en' => 2,
                            'de' => 3,
                        ],
                    ],
                    'exportOptions' => [
                        'exportPattern' => '/localization/%locale%/%file_name%.%file_extension%',
                    ],
                    'excludedTargetLanguages' => ['es', 'pl'],
                    'createdAt' => '2019-09-19T15:10:43+00:00',
                    'updatedAt' => '2019-09-19T15:10:46+00:00',
                ],
            ])
        );

        $file = $this->crowdin->file->get(2, 44);

        $this->assertInstanceOf(File::class, $file);
        $this->assertEquals(44, $file->getId());

        $this->assertEquals('source_app_info', $file->getTitle());
        $this->assertEquals(['es', 'pl'], $file->getExcludedTargetLanguages());

        $file->setTitle('source_app_info edit');
        $file->setExcludedTargetLanguages(['bg', 'es', 'pl']);

        $this->mockRequestPatch(
            '/projects/2/files/44',
            json_encode([
                'data' => [
                    'id' => 44,
                    'projectId' => 2,
                    'branchId' => 34,
                    'directoryId' => 4,
                    'name' => 'umbrella_app.xliff',
                    'title' => 'source_app_info edit',
                    'type' => 'xliff',
                    'path' => '/directory1/directory2/filename.extension',
                    'status' => 'active',
                    'revisionId' => 1,
                    'priority' => 'normal',
                    'importOptions' => [
                        'firstLineContainsHeader' => false,
                        'importTranslations' => true,
                        'scheme' => [
                            'identifier' => 0,
                            'sourcePhrase' => 1,
                            'en' => 2,
                            'de' => 3,
                        ],
                    ],
                    'exportOptions' => [
                        'exportPattern' => '/localization/%locale%/%file_name%.%file_extension%',
                    ],
                    'excludedTargetLanguages' => ['bg', 'es', 'pl'],
                    'createdAt' => '2019-09-19T15:10:43+00:00',
                    'updatedAt' => '2019-09-19T15:10:46+00:00',
                ],
            ])
        );

        $file = $this->crowdin->file->edit($file);

        $this->assertEquals('source_app_info edit', $file->getTitle());
        $this->assertEquals(['bg', 'es', 'pl'], $file->getExcludedTargetLanguages());
    }

    public function testUpdate(): void
    {
        $this->mockRequestPut(
            '/projects/2/files/44',
            json_encode([
                'data' => [
                    'id' => 44,
                    'projectId' => 2,
                    'branchId' => 34,
                    'directoryId' => 4,
                    'name' => 'umbrella_app.xliff',
                    'title' => 'source_app_info',
                    'type' => 'xliff',
                    'path' => '/directory1/directory2/filename.extension',
                    'status' => 'active',
                    'revisionId' => 2,
                    'priority' => 'normal',
                    'importOptions' => [
                        'firstLineContainsHeader' => false,
                        'importTranslations' => true,
                        'scheme' => [
                            'identifier' => 0,
                            'sourcePhrase' => 1,
                            'en' => 2,
                            'de' => 3,
                        ],
                    ],
                    'exportOptions' => [
                        'exportPattern' => '/localization/%locale%/%file_name%.%file_extension%',
                    ],
                    'excludedTargetLanguages' => ['es', 'pl'],
                    'createdAt' => '2019-09-19T15:10:43+00:00',
                    'updatedAt' => '2019-09-19T15:10:46+00:00',
                ],
            ])
        );

        $file = $this->crowdin->file->update(2, 44, ['storageId' => 1]);

        $this->assertInstanceOf(File::class, $file);
        $this->assertEquals(2, $file->getRevisionId());
    }

    public function testRestore(): void
    {
        $this->mockRequestPut(
            '/projects/2/files/44',
            json_encode([
                'data' => [
                    'id' => 44,
                    'projectId' => 2,
                    'branchId' => 34,
                    'directoryId' => 4,
                    'name' => 'umbrella_app.xliff',
                    'title' => 'source_app_info',
                    'type' => 'xliff',
                    'path' => '/directory1/directory2/filename.extension',
                    'status' => 'active',
                    'revisionId' => 19,
                    'priority' => 'normal',
                    'importOptions' => [
                        'firstLineContainsHeader' => false,
                        'importTranslations' => true,
                        'scheme' => [
                            'identifier' => 0,
                            'sourcePhrase' => 1,
                            'en' => 2,
                            'de' => 3,
                        ],
                    ],
                    'exportOptions' => [
                        'exportPattern' => '/localization/%locale%/%file_name%.%file_extension%',
                    ],
                    'excludedTargetLanguages' => ['en', 'es', 'pl'],
                    'createdAt' => '2019-09-19T15:10:43+00:00',
                    'updatedAt' => '2019-09-19T15:10:46+00:00',
                ],
            ])
        );

        $file = $this->crowdin->file->restore(2, 44, ['storageId' => 1]);

        $this->assertInstanceOf(File::class, $file);
        $this->assertEquals(19, $file->getRevisionId());
    }

    public function testCreate(): void
    {
        $params = [
            'storageId' => 61,
            'name' => 'umbrella_app.xliff',
            'branchId' => 34,
            'directoryId' => 4,
            'title' => 'source_app_info',
            'context' => 'Context for translators',
            'type' => 'xliff',
            'importOptions' => [
                'firstLineContainsHeader' => true,
                'scheme' => [
                    'identifier' => 0,
                    'sourcePhrase' => 1,
                    'en' => 2,
                    'de' => 3,
                ],
            ],
            'exportOptions' => [
                'escapeQuotes' => 3,
            ],
            'excludedTargetLanguages' => ['bg'],
        ];

        $this->mockRequest([
            'path' => '/projects/2/files',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => json_encode([
                'data' => [
                    'id' => 44,
                    'projectId' => 2,
                    'branchId' => 34,
                    'directoryId' => 4,
                    'name' => 'umbrella_app.xliff',
                    'title' => 'source_app_info',
                    'context' => 'Context for translators',
                    'type' => 'xliff',
                    'path' => '/directory1/directory2/filename.extension',
                    'status' => 'active',
                    'revisionId' => 1,
                    'priority' => 'normal',
                    'importOptions' => [
                        'firstLineContainsHeader' => false,
                        'importTranslations' => true,
                        'scheme' => [
                            'identifier' => 0,
                            'sourcePhrase' => 1,
                            'en' => 2,
                            'de' => 3,
                        ],
                    ],
                    'exportOptions' => [
                        'exportPattern' => '/localization/%locale%/%file_name%.%file_extension%',
                    ],
                    'excludedTargetLanguages' => ['bg'],
                    'createdAt' => '2019-09-19T15:10:43+00:00',
                    'updatedAt' => '2019-09-19T15:10:46+00:00',
                ],
            ]),
        ]);

        $file = $this->crowdin->file->create(2, $params);

        $this->assertInstanceOf(File::class, $file);
        $this->assertEquals(44, $file->getId());
        $this->assertEquals(["bg"], $file->getExcludedTargetLanguages());
    }

    public function testDelete(): void
    {
        $this->mockRequestDelete('/projects/2/files/44');
        $this->crowdin->file->delete(2, 44);
    }

    public function testDownloadPreview(): void
    {
        $this->mockRequestGet(
            '/projects/2/files/44/preview',
            json_encode([
                'data' => [
                    'url' => 'https://production-enterprise-importer.downloads.crowdin.com/992000002/2/14.xliff',
                    'expireIn' => '2019-09-20T10:31:21+00:00',
                ],
            ])
        );

        $downloadFilePreview = $this->crowdin->file->downloadPreview(2, 44);

        $this->assertInstanceOf(DownloadFilePreview::class, $downloadFilePreview);
        $this->assertEquals(
            'https://production-enterprise-importer.downloads.crowdin.com/992000002/2/14.xliff',
            $downloadFilePreview->getUrl()
        );
    }

    public function testDownload(): void
    {
        $this->mockRequestGet(
            '/projects/2/files/44/download',
            json_encode([
                'data' => [
                    'url' => 'https://production-enterprise-importer.downloads.crowdin.com/992000002/2/14.xliff',
                    'expireIn' => '2019-09-20T10:31:21+00:00',
                ],
            ])
        );

        $downloadFile = $this->crowdin->file->download(2, 44);

        $this->assertInstanceOf(DownloadFile::class, $downloadFile);
        $this->assertEquals(
            'https://production-enterprise-importer.downloads.crowdin.com/992000002/2/14.xliff',
            $downloadFile->getUrl()
        );
    }

    public function testListRevisions(): void
    {
        $this->mockRequestGet(
            '/projects/2/files/44/revisions',
            json_encode([
                'data' => [
                    [
                        'data' => [
                            'id' => 16,
                            'projectId' => 2,
                            'revision' => 2,
                            'revertTo' => 0,
                            'translationChunks' => 1,
                            'info' => [
                                'added' => [
                                    'strings' => 17,
                                    'words' => 43,
                                    'chars' => 242,
                                    'charsWithSpaces' => 268,
                                ],
                                'deleted' => [
                                    'strings' => 17,
                                    'words' => 43,
                                    'chars' => 242,
                                    'charsWithSpaces' => 268,
                                ],
                                'changed' => [
                                    'strings' => 17,
                                    'words' => 43,
                                    'chars' => 242,
                                    'charsWithSpaces' => 268,
                                ],
                                'updated' => [
                                    'strings' => 17,
                                    'words' => 43,
                                    'chars' => 242,
                                    'charsWithSpaces' => 268,
                                ],
                                'translated' => [
                                    'strings' => 17,
                                    'words' => 43,
                                    'chars' => 242,
                                    'charsWithSpaces' => 268,
                                ],
                                'approved' => [
                                    'strings' => 17,
                                    'words' => 43,
                                    'chars' => 242,
                                    'charsWithSpaces' => 268,
                                ],
                                'addedToTranslate' => [
                                    'strings' => 17,
                                    'words' => 43,
                                    'chars' => 242,
                                    'charsWithSpaces' => 268,
                                ],
                            ],
                            'date' => '2019-09-20T09:08:16+00:00',
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

        $revisions = $this->crowdin->file->revisions(2, 44);

        $this->assertInstanceOf(ModelCollection::class, $revisions);
        $this->assertCount(1, $revisions);
        $this->assertInstanceOf(FileRevision::class, $revisions[0]);
        $this->assertEquals(16, $revisions[0]->getId());
    }

    public function testGetRevision(): void
    {
        $this->mockRequestGet(
            '/projects/2/files/44/revisions/16',
            json_encode([
                'data' => [
                    'id' => 16,
                    'projectId' => 2,
                    'revision' => 2,
                    'revertTo' => 0,
                    'translationChunks' => 1,
                    'info' => [
                        'added' => [
                            'strings' => 17,
                            'words' => 43,
                            'chars' => 242,
                            'charsWithSpaces' => 268,
                        ],
                        'deleted' => [
                            'strings' => 17,
                            'words' => 43,
                            'chars' => 242,
                            'charsWithSpaces' => 268,
                        ],
                        'changed' => [
                            'strings' => 17,
                            'words' => 43,
                            'chars' => 242,
                            'charsWithSpaces' => 268,
                        ],
                        'updated' => [
                            'strings' => 17,
                            'words' => 43,
                            'chars' => 242,
                            'charsWithSpaces' => 268,
                        ],
                        'translated' => [
                            'strings' => 17,
                            'words' => 43,
                            'chars' => 242,
                            'charsWithSpaces' => 268,
                        ],
                        'approved' => [
                            'strings' => 17,
                            'words' => 43,
                            'chars' => 242,
                            'charsWithSpaces' => 268,
                        ],
                        'addedToTranslate' => [
                            'strings' => 17,
                            'words' => 43,
                            'chars' => 242,
                            'charsWithSpaces' => 268,
                        ],
                    ],
                    'date' => '2019-09-20T09:08:16+00:00',
                ],
            ])
        );

        $fileRevision = $this->crowdin->file->getRevision(2, 44, 16);

        $this->assertInstanceOf(FileRevision::class, $fileRevision);
        $this->assertEquals(16, $fileRevision->getId());
    }
}
