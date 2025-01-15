<?php

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\Progress;
use CrowdinApiClient\Model\ProgressLanguage;
use CrowdinApiClient\Model\QaCheck;
use CrowdinApiClient\ModelCollection;

class TranslationStatusApiTest extends AbstractTestApi
{
    public function testGetBranchProgress(): void
    {
        $this->mockRequestGet(
            '/projects/1/branches/1/languages/progress?limit=10',
            json_encode([
                'data' => [
                    [
                        'data' => [
                            'languageId' => 'es',
                            'language' => [
                                'id' => 'es',
                                'name' => 'Spanish',
                                'editorCode' => 'es',
                                'twoLettersCode' => 'es',
                                'threeLettersCode' => 'spa',
                                'locale' => 'es-ES',
                                'androidCode' => 'es-rES',
                                'osxCode' => 'es.lproj',
                                'osxLocale' => 'es',
                                'pluralCategoryNames' => ['one'],
                                'pluralRules' => '(n != 1)',
                                'pluralExamples' => ['0, 2-999; 1.2, 2.07...'],
                                'textDirection' => 'ltr',
                                'dialectOf' => 'es',
                            ],
                            'words' => [
                                'total' => 7249,
                                'translated' => 3651,
                                'approved' => 3637,
                            ],
                            'phrases' => [
                                'total' => 3041,
                                'translated' => 2631,
                                'approved' => 2622,
                            ],
                            'translationProgress' => 86,
                            'approvalProgress' => 86,
                        ],
                    ],
                ],
                'pagination' => [
                    [
                        'offset' => 0,
                        'limit' => 10,
                    ],
                ],
            ])
        );

        $branchProgress = $this->crowdin->translationStatus->getBranchProgress(1, 1, ['limit' => 10]);

        $this->assertInstanceOf(ModelCollection::class, $branchProgress);
        $this->assertCount(1, $branchProgress);
        $this->assertInstanceOf(Progress::class, $branchProgress[0]);
        $this->assertEquals('es', $branchProgress[0]->getLanguageId());
    }

    public function testGetDirectoryProgress(): void
    {
        $this->mockRequestGet(
            '/projects/1/directories/2/languages/progress?limit=10',
            json_encode([
                'data' => [
                    [
                        'data' => [
                            'languageId' => 'es',
                            'language' => [
                                'id' => 'es',
                                'name' => 'Spanish',
                                'editorCode' => 'es',
                                'twoLettersCode' => 'es',
                                'threeLettersCode' => 'spa',
                                'locale' => 'es-ES',
                                'androidCode' => 'es-rES',
                                'osxCode' => 'es.lproj',
                                'osxLocale' => 'es',
                                'pluralCategoryNames' => ['one'],
                                'pluralRules' => '(n != 1)',
                                'pluralExamples' => ['0, 2-999; 1.2, 2.07...'],
                                'textDirection' => 'ltr',
                                'dialectOf' => 'es',
                            ],
                            'words' => [
                                'total' => 7249,
                                'translated' => 3651,
                                'approved' => 3637,
                            ],
                            'phrases' => [
                                'total' => 3041,
                                'translated' => 2631,
                                'approved' => 2622,
                            ],
                            'translationProgress' => 86,
                            'approvalProgress' => 86,
                        ],
                    ],
                ],
                'pagination' => [
                    [
                        'offset' => 0,
                        'limit' => 10,
                    ],
                ],
            ])
        );

        $progress = $this->crowdin->translationStatus->getDirectoryProgress(1, 2, ['limit' => 10]);

        $this->assertInstanceOf(ModelCollection::class, $progress);
        $this->assertCount(1, $progress);
        $this->assertInstanceOf(Progress::class, $progress[0]);
        $this->assertEquals('es', $progress[0]->getLanguageId());
    }

    public function testGetFileProgress(): void
    {
        $this->mockRequestGet(
            '/projects/1/files/3/languages/progress?limit=10',
            json_encode([
                'data' => [
                    [
                        'data' => [
                            'languageId' => 'es',
                            'language' => [
                                'id' => 'es',
                                'name' => 'Spanish',
                                'editorCode' => 'es',
                                'twoLettersCode' => 'es',
                                'threeLettersCode' => 'spa',
                                'locale' => 'es-ES',
                                'androidCode' => 'es-rES',
                                'osxCode' => 'es.lproj',
                                'osxLocale' => 'es',
                                'pluralCategoryNames' => ['one'],
                                'pluralRules' => '(n != 1)',
                                'pluralExamples' => ['0, 2-999; 1.2, 2.07...'],
                                'textDirection' => 'ltr',
                                'dialectOf' => 'es',
                            ],
                            'words' => [
                                'total' => 7249,
                                'translated' => 3651,
                                'approved' => 3637,
                            ],
                            'phrases' => [
                                'total' => 3041,
                                'translated' => 2631,
                                'approved' => 2622,
                            ],
                            'translationProgress' => 86,
                            'approvalProgress' => 86,
                        ],
                    ],
                ],
                'pagination' => [
                    [
                        'offset' => 0,
                        'limit' => 10,
                    ],
                ],
            ])
        );

        $progress = $this->crowdin->translationStatus->getFileProgress(1, 3, ['limit' => 10]);

        $this->assertInstanceOf(ModelCollection::class, $progress);
        $this->assertCount(1, $progress);
        $this->assertInstanceOf(Progress::class, $progress[0]);
        $this->assertEquals('es', $progress[0]->getLanguageId());
    }

    public function testGetLanguageProgress(): void
    {
        $this->mockRequestGet(
            '/projects/1/languages/af/progress?limit=10',
            json_encode([
                'data' => [
                    [
                        'data' => [
                            'words' => [
                                'total' => 7249,
                                'translated' => 3651,
                                'approved' => 3637,
                            ],
                            'phrases' => [
                                'total' => 3041,
                                'translated' => 2631,
                                'approved' => 2622,
                            ],
                            'translationProgress' => 86,
                            'approvalProgress' => 86,
                            'fileId' => 12,
                            'etag' => 'fd0ea167420ef1687fd16635b9fb67a3',
                        ],
                    ],
                ],
                'pagination' => [
                    [
                        'offset' => 0,
                        'limit' => 10,
                    ],
                ],
            ])
        );

        $progress = $this->crowdin->translationStatus->getLanguageProgress(1, 'af', ['limit' => 10]);

        $this->assertInstanceOf(ModelCollection::class, $progress);
        $this->assertCount(1, $progress);
        $this->assertInstanceOf(ProgressLanguage::class, $progress[0]);
        $this->assertEquals(12, $progress[0]->getFileId());
    }

    public function testGetProjectProgress(): void
    {
        $this->mockRequestGet(
            '/projects/1/languages/progress?limit=10',
            json_encode([
                'data' => [
                    [
                        'data' => [
                            'languageId' => 'es',
                            'language' => [
                                'id' => 'es',
                                'name' => 'Spanish',
                                'editorCode' => 'es',
                                'twoLettersCode' => 'es',
                                'threeLettersCode' => 'spa',
                                'locale' => 'es-ES',
                                'androidCode' => 'es-rES',
                                'osxCode' => 'es.lproj',
                                'osxLocale' => 'es',
                                'pluralCategoryNames' => ['one'],
                                'pluralRules' => '(n != 1)',
                                'pluralExamples' => ['0, 2-999; 1.2, 2.07...'],
                                'textDirection' => 'ltr',
                                'dialectOf' => 'es',
                            ],
                            'words' => [
                                'total' => 7249,
                                'translated' => 3651,
                                'approved' => 3637,
                            ],
                            'phrases' => [
                                'total' => 3041,
                                'translated' => 2631,
                                'approved' => 2622,
                            ],
                            'translationProgress' => 86,
                            'approvalProgress' => 86,
                        ],
                    ],
                ],
                'pagination' => [
                    [
                        'offset' => 0,
                        'limit' => 10,
                    ],
                ],
            ])
        );

        $progress = $this->crowdin->translationStatus->getProjectProgress(1, ['limit' => 10]);

        $this->assertInstanceOf(ModelCollection::class, $progress);
        $this->assertCount(1, $progress);
        $this->assertInstanceOf(Progress::class, $progress[0]);
        $this->assertEquals('es', $progress[0]->getLanguageId());
    }

    public function testListQACheckIssues(): void
    {
        $this->mockRequestGet(
            '/projects/1/qa-checks?limit=10',
            json_encode([
                'data' => [
                    [
                        'data' => [
                            'stringId' => 1,
                            'languageId' => 'uk',
                            'category' => 'variables',
                            'categoryDescription' => 'Variables mismatch',
                            'validation' => 'python_variables_check',
                            'validationDescription' => 'Variables mismatch',
                            'pluralId' => 0,
                            'text' => 0,
                        ],
                    ],
                ],
                'pagination' => [
                    [
                        'offset' => 0,
                        'limit' => 10,
                    ],
                ],
            ])
        );

        $qaCheckIssues = $this->crowdin->translationStatus->listQACheckIssues(1, ['limit' => 10]);

        $this->assertInstanceOf(ModelCollection::class, $qaCheckIssues);
        $this->assertCount(1, $qaCheckIssues);
        $this->assertInstanceOf(QaCheck::class, $qaCheckIssues[0]);
        $this->assertEquals(1, $qaCheckIssues[0]->getStringId());
    }
}
