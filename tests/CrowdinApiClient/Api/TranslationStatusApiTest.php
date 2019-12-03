<?php

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\Issue;
use CrowdinApiClient\Model\Progress;
use CrowdinApiClient\Model\QaCheck;
use CrowdinApiClient\ModelCollection;

/**
 * Class TranslationStatusApiTest
 * @package CrowdinApiClient\Tests\Api
 */
class TranslationStatusApiTest extends AbstractTestApi
{
    /**
     * @test
     */
    public function testListReportedIssues()
    {
        $this->mockRequestGet('/projects/1/issues', '{
              "data": [
                {
                  "data": {
                    "id": 2,
                    "text": "@BeMyEyes  Please provide more details on where the text will be used",
                    "userId": 6,
                    "stringId": 742,
                    "languageId": "bg",
                    "type": "source_mistake",
                    "status": "unresolved",
                    "createdAt": "2019-09-20T11:05:24+00:00"
                  }
                }
              ],
              "pagination": [
                {
                  "offset": 0,
                  "limit": 25
                }
              ]
            }');

        $issues = $this->crowdin->translationStatus->listReportedIssues(1);

        $this->assertInstanceOf(ModelCollection::class, $issues);
        $this->assertCount(1, $issues);
        $this->assertInstanceOf(Issue::class, $issues[0]);
        $this->assertEquals(2, $issues[0]->getId());
    }

    /**
     * @test
     */
    public function testGetBranchProgress()
    {
        $this->mockRequestGet('/projects/1/branches/1/languages/progress', '{
          "data": [
            {
              "data": {
                "languageId": "af",
                "phrasesCount": 3041,
                "phrasesTranslatedCount": 2631,
                "phrasesApprovedCount": 2622,
                "phrasesTranslatedProgress": 86,
                "phrasesApprovedProgress": 86
              }
            }
          ],
          "pagination": [
            {
              "offset": 0,
              "limit": 25
            }
          ]
        }');

        $branchProgress = $this->crowdin->translationStatus->getBranchProgress(1, 1);

        $this->assertInstanceOf(ModelCollection::class, $branchProgress);
        $this->assertCount(1, $branchProgress);
        $this->assertInstanceOf(Progress::class, $branchProgress[0]);
        $this->assertEquals('af', $branchProgress[0]->getLanguageId());
    }

    public function testGetDirectoryProgress()
    {
        $this->mockRequestGet('/projects/1/directories/2/languages/progress', '{
              "data": [
                {
                  "data": {
                    "languageId": "af",
                    "phrasesCount": 3041,
                    "phrasesTranslatedCount": 2631,
                    "phrasesApprovedCount": 2622,
                    "phrasesTranslatedProgress": 86,
                    "phrasesApprovedProgress": 86
                  }
                }
              ],
              "pagination": [
                {
                  "offset": 0,
                  "limit": 25
                }
              ]
            }');

        $progress = $this->crowdin->translationStatus->getDirectoryProgress(1, 2);

        $this->assertInstanceOf(ModelCollection::class, $progress);
        $this->assertCount(1, $progress);
        $this->assertInstanceOf(Progress::class, $progress[0]);
        $this->assertEquals('af', $progress[0]->getLanguageId());
    }

    /**
     * @test
     */
    public function testGetFileProgress()
    {
        $this->mockRequestGet('/projects/1/files/3/languages/progress', '{
              "data": [
                {
                  "data": {
                    "languageId": "af",
                    "phrasesCount": 3041,
                    "phrasesTranslatedCount": 2631,
                    "phrasesApprovedCount": 2622,
                    "phrasesTranslatedProgress": 86,
                    "phrasesApprovedProgress": 86
                  }
                }
              ],
              "pagination": [
                {
                  "offset": 0,
                  "limit": 25
                }
              ]
            }');

        $progress = $this->crowdin->translationStatus->getFileProgress(1, 3);

        $this->assertInstanceOf(ModelCollection::class, $progress);
        $this->assertCount(1, $progress);
        $this->assertInstanceOf(Progress::class, $progress[0]);
        $this->assertEquals('af', $progress[0]->getLanguageId());
    }

    /**
     * @test
     */
    public function testGetProjectProgress()
    {
        $this->mockRequestGet('/projects/1/languages/progress', '{
              "data": [
                {
                  "data": {
                    "languageId": "af",
                    "phrasesCount": 3041,
                    "phrasesTranslatedCount": 2631,
                    "phrasesApprovedCount": 2622,
                    "phrasesTranslatedProgress": 86,
                    "phrasesApprovedProgress": 86
                  }
                }
              ],
              "pagination": [
                {
                  "offset": 0,
                  "limit": 25
                }
              ]
            }');

        $progress = $this->crowdin->translationStatus->getProjectProgress(1);

        $this->assertInstanceOf(ModelCollection::class, $progress);
        $this->assertCount(1, $progress);
        $this->assertInstanceOf(Progress::class, $progress[0]);
        $this->assertEquals('af', $progress[0]->getLanguageId());
    }

    /**
     * @test
     */
    public function testListQACheckIssues()
    {
        $this->mockRequestGet('/projects/1/qa-check', '{
                  "data": [
                    {
                      "data": {
                        "stringId": 1,
                        "languageId": "uk",
                        "category": "variables",
                        "categoryDescription": "Variables mismatch",
                        "validation": "python_variables_check",
                        "validationDescription": "Variables mismatch",
                        "pluralId": 0,
                        "text": 0
                      }
                    }
                  ],
                  "pagination": [
                    {
                      "offset": 0,
                      "limit": 25
                    }
                  ]
                }');

        $QACheckIssues = $this->crowdin->translationStatus->listQACheckIssues(1);

        $this->assertInstanceOf(ModelCollection::class, $QACheckIssues);
        $this->assertCount(1, $QACheckIssues);
        $this->assertInstanceOf(QaCheck::class, $QACheckIssues[0]);
        $this->assertEquals(1, $QACheckIssues[0]->getStringId());
    }
}
