<?php

namespace CrowdinApiClient\Tests\Api\Enterprise;

use CrowdinApiClient\Model\AiCustomPlaceholder;
use CrowdinApiClient\Model\AiFileTranslation;
use CrowdinApiClient\Model\AiFineTuningDataset;
use CrowdinApiClient\Model\AiFineTuningEvent;
use CrowdinApiClient\Model\AiFineTuningJob;
use CrowdinApiClient\Model\AiPrompt;
use CrowdinApiClient\Model\AiPromptCompletion;
use CrowdinApiClient\Model\AiProvider;
use CrowdinApiClient\Model\AiProviderModel;
use CrowdinApiClient\Model\AiProxyChatCompletion;
use CrowdinApiClient\Model\AiReport;
use CrowdinApiClient\Model\AiSettings;
use CrowdinApiClient\Model\AiSnippet;
use CrowdinApiClient\Model\AiTranslation;
use CrowdinApiClient\Model\DownloadFile;
use CrowdinApiClient\ModelCollection;

class AiApiTest extends AbstractTestApi
{
    public function testTranslateStrings(): void
    {
        $params = [
            'strings' => ['Some text to translate!'],
            'sourceLanguageId' => 'en',
            'targetLanguageId' => 'uk',
        ];

        $this->mockRequest([
            'path' => '/ai/translate',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => '{
              "data": {
                "sourceLanguageId": "en",
                "targetLanguageId": "uk",
                "translations": [
                  "Перекладений текст 1",
                  "Перекладений текст 2"
                ]
              }
            }',
        ]);

        $aiTranslation = $this->crowdin->ai->translateStrings($params);
        $this->assertInstanceOf(AiTranslation::class, $aiTranslation);
        $this->assertEquals('en', $aiTranslation->getSourceLanguageId());
        $this->assertEquals('uk', $aiTranslation->getTargetLanguageId());
        $this->assertEquals(['Перекладений текст 1', 'Перекладений текст 2'], $aiTranslation->getTranslations());
    }

    public function testCreateFileTranslation(): void
    {
        $params = [
            'storageId' => 123,
            'sourceLanguageId' => 'en',
            'targetLanguageId' => 'uk',
            'type' => 'xliff',
            'parserVersion' => 1,
            'tmIds' => [123],
            'glossaryIds' => [456],
            'styleGuideIds' => [654],
            'aiPromptId' => 789,
            'instructions' => ['Keep a formal tone'],
            'attachmentIds' => [123],
        ];

        $this->mockRequest([
            'path' => '/ai/file-translations',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => '{
              "data": {
                "identifier": "50fb3506-4127-4ba8-8296-f97dc7e3e0c3",
                "status": "finished",
                "progress": 100,
                "attributes": {
                  "stage": "translate",
                  "error": null,
                  "downloadName": "file.pdf",
                  "sourceLanguageId": "en",
                  "targetLanguageId": "uk",
                  "originalFileName": "Sample_Chrome.json",
                  "detectedType": "chrome",
                  "parserVersion": 2
                },
                "createdAt": "2026-01-23T11:26:54+00:00",
                "updatedAt": "2026-01-23T11:26:54+00:00",
                "startedAt": "2026-01-23T11:26:54+00:00",
                "finishedAt": "2026-01-23T11:26:54+00:00"
              }
            }',
        ]);

        $fileTranslation = $this->crowdin->ai->createFileTranslation($params);
        $this->assertInstanceOf(AiFileTranslation::class, $fileTranslation);
        $this->assertEquals('50fb3506-4127-4ba8-8296-f97dc7e3e0c3', $fileTranslation->getIdentifier());
        $this->assertEquals('finished', $fileTranslation->getStatus());
        $this->assertEquals(100, $fileTranslation->getProgress());
        $this->assertEquals('uk', $fileTranslation->getAttributes()['targetLanguageId']);
    }

    public function testGetFileTranslation(): void
    {
        $this->mockRequest([
            'path' => '/ai/file-translations/50fb3506-4127-4ba8-8296-f97dc7e3e0c3',
            'method' => 'get',
            'response' => '{
              "data": {
                "identifier": "50fb3506-4127-4ba8-8296-f97dc7e3e0c3",
                "status": "finished",
                "progress": 100,
                "attributes": {
                  "stage": "translate",
                  "error": null,
                  "downloadName": "file.pdf",
                  "sourceLanguageId": "en",
                  "targetLanguageId": "uk",
                  "originalFileName": "Sample_Chrome.json",
                  "detectedType": "chrome",
                  "parserVersion": 2
                },
                "createdAt": "2026-01-23T11:26:54+00:00",
                "updatedAt": "2026-01-23T11:26:54+00:00",
                "startedAt": "2026-01-23T11:26:54+00:00",
                "finishedAt": "2026-01-23T11:26:54+00:00"
              }
            }',
        ]);

        $fileTranslation = $this->crowdin->ai->getFileTranslation('50fb3506-4127-4ba8-8296-f97dc7e3e0c3');
        $this->assertInstanceOf(AiFileTranslation::class, $fileTranslation);
        $this->assertEquals('50fb3506-4127-4ba8-8296-f97dc7e3e0c3', $fileTranslation->getIdentifier());
        $this->assertEquals('finished', $fileTranslation->getStatus());
        $this->assertEquals(100, $fileTranslation->getProgress());
        $this->assertEquals('2026-01-23T11:26:54+00:00', $fileTranslation->getCreatedAt());
        $this->assertEquals('2026-01-23T11:26:54+00:00', $fileTranslation->getUpdatedAt());
        $this->assertEquals('2026-01-23T11:26:54+00:00', $fileTranslation->getStartedAt());
        $this->assertEquals('2026-01-23T11:26:54+00:00', $fileTranslation->getFinishedAt());
    }

    public function testDeleteFileTranslation(): void
    {
        $this->mockRequest([
            'path' => '/ai/file-translations/50fb3506-4127-4ba8-8296-f97dc7e3e0c3',
            'method' => 'delete',
            'response' => '',
        ]);

        $this->crowdin->ai->deleteFileTranslation('50fb3506-4127-4ba8-8296-f97dc7e3e0c3');
    }

    public function testDownloadFileTranslation(): void
    {
        $this->mockRequest([
            'path' => '/ai/file-translations/50fb3506-4127-4ba8-8296-f97dc7e3e0c3/download',
            'method' => 'get',
            'response' => '{
              "data": {
                "url": "https://production-enterprise-importer.downloads.crowdin.com/992000002/2/14.xliff",
                "expireIn": "2019-09-20T10:31:21+00:00"
              }
            }',
        ]);

        $downloadFile = $this->crowdin->ai->downloadFileTranslation('50fb3506-4127-4ba8-8296-f97dc7e3e0c3');
        $this->assertInstanceOf(DownloadFile::class, $downloadFile);
        $this->assertEquals('https://production-enterprise-importer.downloads.crowdin.com/992000002/2/14.xliff', $downloadFile->getUrl());
        $this->assertEquals('2019-09-20T10:31:21+00:00', $downloadFile->getExpireIn());
    }

    public function testDownloadFileTranslationStrings(): void
    {
        $this->mockRequest([
            'path' => '/ai/file-translations/50fb3506-4127-4ba8-8296-f97dc7e3e0c3/translations',
            'method' => 'get',
            'response' => '{
              "data": {
                "url": "https://production-enterprise-importer.downloads.crowdin.com/992000002/2/14.xliff",
                "expireIn": "2019-09-20T10:31:21+00:00"
              }
            }',
        ]);

        $downloadFile = $this->crowdin->ai->downloadFileTranslationStrings('50fb3506-4127-4ba8-8296-f97dc7e3e0c3');
        $this->assertInstanceOf(DownloadFile::class, $downloadFile);
        $this->assertEquals('https://production-enterprise-importer.downloads.crowdin.com/992000002/2/14.xliff', $downloadFile->getUrl());
        $this->assertEquals('2019-09-20T10:31:21+00:00', $downloadFile->getExpireIn());
    }

    public function testListPrompts(): void
    {
        $this->mockRequest([
            'path' => '/ai/prompts',
            'method' => 'get',
            'response' => '{
              "data": [
                {
                  "data": {
                    "id": 2,
                    "name": "Pre-translate prompt",
                    "action": "pre_translate",
                    "aiProviderId": 2,
                    "aiModelId": "gpt-5.4",
                    "isEnabled": true,
                    "enabledProjectIds": [1],
                    "config": {},
                    "promptPreview": null,
                    "isFineTuningAvailable": true,
                    "createdBy": 123,
                    "updatedBy": 456,
                    "lastUsedBy": 789,
                    "lastUsedAt": "2019-09-25T14:30:00+00:00",
                    "usageCount": 42,
                    "createdAt": "2019-09-20T11:11:05+00:00",
                    "updatedAt": "2019-09-20T12:22:20+00:00"
                  }
                }
              ],
              "pagination": {"offset": 0, "limit": 25}
            }',
        ]);

        $prompts = $this->crowdin->ai->listPrompts();
        $this->assertInstanceOf(ModelCollection::class, $prompts);
        $this->assertInstanceOf(AiPrompt::class, $prompts[0]);
        $this->assertEquals(2, $prompts[0]->getId());
        $this->assertEquals('pre_translate', $prompts[0]->getAction());
    }

    public function testCreatePrompt(): void
    {
        $params = [
            'name' => 'Pre-translate prompt',
            'action' => 'pre_translate',
            'config' => ['mode' => 'basic'],
        ];

        $this->mockRequest([
            'path' => '/ai/prompts',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => '{
              "data": {
                "id": 2,
                "name": "Pre-translate prompt",
                "action": "pre_translate",
                "aiProviderId": 2,
                "aiModelId": "gpt-5.4",
                "isEnabled": true,
                "enabledProjectIds": [1],
                "config": {"mode": "basic"},
                "promptPreview": null,
                "isFineTuningAvailable": true,
                "createdBy": 123,
                "updatedBy": 456,
                "lastUsedBy": 789,
                "lastUsedAt": "2019-09-25T14:30:00+00:00",
                "usageCount": 42,
                "createdAt": "2019-09-20T11:11:05+00:00",
                "updatedAt": "2019-09-20T12:22:20+00:00"
              }
            }',
        ]);

        $prompt = $this->crowdin->ai->createPrompt($params);
        $this->assertInstanceOf(AiPrompt::class, $prompt);
        $this->assertEquals(2, $prompt->getId());
        $this->assertEquals('Pre-translate prompt', $prompt->getName());
    }

    public function testGetPrompt(): void
    {
        $this->mockRequest([
            'path' => '/ai/prompts/2',
            'method' => 'get',
            'response' => '{
              "data": {
                "id": 2,
                "name": "Pre-translate prompt",
                "action": "pre_translate",
                "aiProviderId": 2,
                "aiModelId": "gpt-5.4",
                "isEnabled": true,
                "enabledProjectIds": [1],
                "config": {
                  "mode": "basic",
                  "snippets": ["%custom:companyDescription%"],
                  "glossaryTerms": true,
                  "tmSuggestions": true,
                  "fileContext": true
                },
                "promptPreview": null,
                "isFineTuningAvailable": true,
                "createdBy": 123,
                "updatedBy": 456,
                "lastUsedBy": 789,
                "lastUsedAt": "2019-09-25T14:30:00+00:00",
                "usageCount": 42,
                "createdAt": "2019-09-20T11:11:05+00:00",
                "updatedAt": "2019-09-20T12:22:20+00:00"
              }
            }',
        ]);

        $prompt = $this->crowdin->ai->getPrompt(2);
        $this->assertInstanceOf(AiPrompt::class, $prompt);
        $this->assertEquals(2, $prompt->getId());
        $this->assertTrue($prompt->isFineTuningAvailable());
        $this->assertEquals(42, $prompt->getUsageCount());
        $this->assertEquals([1], $prompt->getEnabledProjectIds());
        $this->assertNull($prompt->getPromptPreview());
        $this->assertEquals(123, $prompt->getCreatedBy());
        $this->assertEquals(456, $prompt->getUpdatedBy());
        $this->assertEquals(789, $prompt->getLastUsedBy());
        $this->assertEquals('2019-09-25T14:30:00+00:00', $prompt->getLastUsedAt());
        $this->assertEquals('2019-09-20T11:11:05+00:00', $prompt->getCreatedAt());
        $this->assertEquals('2019-09-20T12:22:20+00:00', $prompt->getUpdatedAt());
        $this->assertIsArray($prompt->getConfig());
    }

    public function testDeletePrompt(): void
    {
        $this->mockRequest([
            'path' => '/ai/prompts/2',
            'method' => 'delete',
            'response' => '',
        ]);

        $this->crowdin->ai->deletePrompt(2);
    }

    public function testClonePrompt(): void
    {
        $params = [
            'name' => 'Pre-translate prompt',
        ];

        $this->mockRequest([
            'path' => '/ai/prompts/2/clones',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => '{
              "data": {
                "id": 2,
                "name": "Pre-translate prompt",
                "action": "pre_translate",
                "aiProviderId": 2,
                "aiModelId": "gpt-5.4",
                "isEnabled": true,
                "enabledProjectIds": [1],
                "config": {},
                "promptPreview": null,
                "isFineTuningAvailable": true,
                "createdBy": 123,
                "updatedBy": 456,
                "lastUsedBy": 789,
                "lastUsedAt": "2019-09-25T14:30:00+00:00",
                "usageCount": 42,
                "createdAt": "2019-09-20T11:11:05+00:00",
                "updatedAt": "2019-09-20T12:22:20+00:00"
              }
            }',
        ]);

        $cloned = $this->crowdin->ai->clonePrompt(2, $params);
        $this->assertInstanceOf(AiPrompt::class, $cloned);
        $this->assertEquals(2, $cloned->getId());
        $this->assertEquals('Pre-translate prompt', $cloned->getName());
    }

    public function testCreatePromptCompletion(): void
    {
        $params = [
            'resources' => [
                'projectId' => 123,
                'targetLanguageId' => 'uk',
                'stringIds' => [78253],
            ],
        ];

        $this->mockRequest([
            'path' => '/ai/prompts/2/completions',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => '{
              "data": {
                "identifier": "50fb3506-4127-4ba8-8296-f97dc7e3e0c3",
                "status": "finished",
                "progress": 100,
                "attributes": {
                  "aiPromptId": 38
                },
                "createdAt": "2019-09-23T11:26:54+00:00",
                "updatedAt": "2019-09-23T11:26:54+00:00",
                "startedAt": "2019-09-23T11:26:54+00:00",
                "finishedAt": "2019-09-23T11:26:54+00:00"
              }
            }',
        ]);

        $completion = $this->crowdin->ai->createPromptCompletion(2, $params);
        $this->assertInstanceOf(AiPromptCompletion::class, $completion);
        $this->assertEquals('50fb3506-4127-4ba8-8296-f97dc7e3e0c3', $completion->getIdentifier());
        $this->assertEquals('finished', $completion->getStatus());
    }

    public function testGetPromptCompletion(): void
    {
        $this->mockRequest([
            'path' => '/ai/prompts/2/completions/50fb3506-4127-4ba8-8296-f97dc7e3e0c3',
            'method' => 'get',
            'response' => '{
              "data": {
                "identifier": "50fb3506-4127-4ba8-8296-f97dc7e3e0c3",
                "status": "finished",
                "progress": 100,
                "attributes": {
                  "aiPromptId": 38
                },
                "createdAt": "2019-09-23T11:26:54+00:00",
                "updatedAt": "2019-09-23T11:26:54+00:00",
                "startedAt": "2019-09-23T11:26:54+00:00",
                "finishedAt": "2019-09-23T11:26:54+00:00"
              }
            }',
        ]);

        $completion = $this->crowdin->ai->getPromptCompletion(2, '50fb3506-4127-4ba8-8296-f97dc7e3e0c3');
        $this->assertInstanceOf(AiPromptCompletion::class, $completion);
        $this->assertEquals('finished', $completion->getStatus());
        $this->assertEquals(100, $completion->getProgress());
        $this->assertEquals('2019-09-23T11:26:54+00:00', $completion->getCreatedAt());
        $this->assertEquals('2019-09-23T11:26:54+00:00', $completion->getUpdatedAt());
        $this->assertEquals('2019-09-23T11:26:54+00:00', $completion->getStartedAt());
        $this->assertEquals('2019-09-23T11:26:54+00:00', $completion->getFinishedAt());
    }

    public function testDeletePromptCompletion(): void
    {
        $this->mockRequest([
            'path' => '/ai/prompts/2/completions/50fb3506-4127-4ba8-8296-f97dc7e3e0c3',
            'method' => 'delete',
            'response' => '',
        ]);

        $this->crowdin->ai->deletePromptCompletion(2, '50fb3506-4127-4ba8-8296-f97dc7e3e0c3');
    }

    public function testDownloadPromptCompletion(): void
    {
        $this->mockRequest([
            'path' => '/ai/prompts/2/completions/50fb3506-4127-4ba8-8296-f97dc7e3e0c3/download',
            'method' => 'get',
            'response' => '{
              "data": {
                "url": "https://production-enterprise-importer.downloads.crowdin.com/992000002/2/14.xliff",
                "expireIn": "2019-09-20T10:31:21+00:00"
              }
            }',
        ]);

        $download = $this->crowdin->ai->downloadPromptCompletion(2, '50fb3506-4127-4ba8-8296-f97dc7e3e0c3');
        $this->assertInstanceOf(DownloadFile::class, $download);
        $this->assertEquals('https://production-enterprise-importer.downloads.crowdin.com/992000002/2/14.xliff', $download->getUrl());
        $this->assertEquals('2019-09-20T10:31:21+00:00', $download->getExpireIn());
    }

    public function testCreateFineTuningDataset(): void
    {
        $params = [
            'projectIds' => [1, 2, 3],
            'tmIds' => [4, 5],
            'purpose' => 'training',
            'dateFrom' => '2019-09-23T11:26:54+00:00',
            'dateTo' => '2019-09-23T11:26:54+00:00',
            'maxFileSize' => 1000000,
            'minExamplesCount' => 100,
            'maxExamplesCount' => 10000,
        ];

        $this->mockRequest([
            'path' => '/ai/prompts/2/fine-tuning/datasets',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => '{
              "data": {
                "identifier": "50fb3506-4127-4ba8-8296-f97dc7e3e0c3",
                "status": "finished",
                "progress": 100,
                "attributes": {
                  "projectIds": [1, 2, 3],
                  "tmIds": [4, 5],
                  "purpose": "training",
                  "dateFrom": "2019-09-23T11:26:54+00:00",
                  "dateTo": "2019-09-23T11:26:54+00:00",
                  "maxFileSize": 1000000,
                  "minExamplesCount": 100,
                  "maxExamplesCount": 10000
                },
                "createdAt": "2019-09-23T11:26:54+00:00",
                "updatedAt": "2019-09-23T11:26:54+00:00",
                "startedAt": "2019-09-23T11:26:54+00:00",
                "finishedAt": "2019-09-23T11:26:54+00:00"
              }
            }',
        ]);

        $dataset = $this->crowdin->ai->createFineTuningDataset(2, $params);
        $this->assertInstanceOf(AiFineTuningDataset::class, $dataset);
        $this->assertEquals('50fb3506-4127-4ba8-8296-f97dc7e3e0c3', $dataset->getIdentifier());
        $this->assertEquals('finished', $dataset->getStatus());
    }

    public function testGetFineTuningDataset(): void
    {
        $this->mockRequest([
            'path' => '/ai/prompts/2/fine-tuning/datasets/50fb3506-4127-4ba8-8296-f97dc7e3e0c3',
            'method' => 'get',
            'response' => '{
              "data": {
                "identifier": "50fb3506-4127-4ba8-8296-f97dc7e3e0c3",
                "status": "finished",
                "progress": 100,
                "attributes": {
                  "projectIds": [1, 2, 3],
                  "tmIds": [4, 5, 6],
                  "purpose": "training",
                  "dateFrom": "2019-09-23T11:26:54+00:00",
                  "dateTo": "2019-09-23T11:26:54+00:00",
                  "maxFileSize": 1000000,
                  "minExamplesCount": 100,
                  "maxExamplesCount": 10000
                },
                "createdAt": "2019-09-23T11:26:54+00:00",
                "updatedAt": "2019-09-23T11:26:54+00:00",
                "startedAt": "2019-09-23T11:26:54+00:00",
                "finishedAt": "2019-09-23T11:26:54+00:00"
              }
            }',
        ]);

        $dataset = $this->crowdin->ai->getFineTuningDataset(2, '50fb3506-4127-4ba8-8296-f97dc7e3e0c3');
        $this->assertInstanceOf(AiFineTuningDataset::class, $dataset);
        $this->assertEquals('finished', $dataset->getStatus());
        $this->assertEquals(100, $dataset->getProgress());
        $this->assertIsArray($dataset->getAttributes());
        $this->assertEquals('2019-09-23T11:26:54+00:00', $dataset->getCreatedAt());
        $this->assertEquals('2019-09-23T11:26:54+00:00', $dataset->getUpdatedAt());
        $this->assertEquals('2019-09-23T11:26:54+00:00', $dataset->getStartedAt());
        $this->assertEquals('2019-09-23T11:26:54+00:00', $dataset->getFinishedAt());
    }

    public function testDownloadFineTuningDataset(): void
    {
        $this->mockRequest([
            'path' => '/ai/prompts/2/fine-tuning/datasets/50fb3506-4127-4ba8-8296-f97dc7e3e0c3/download',
            'method' => 'get',
            'response' => '{
              "data": {
                "url": "https://production-enterprise-importer.downloads.crowdin.com/992000002/2/14.xliff",
                "expireIn": "2019-09-20T10:31:21+00:00"
              }
            }',
        ]);

        $download = $this->crowdin->ai->downloadFineTuningDataset(2, '50fb3506-4127-4ba8-8296-f97dc7e3e0c3');
        $this->assertInstanceOf(DownloadFile::class, $download);
        $this->assertEquals('https://production-enterprise-importer.downloads.crowdin.com/992000002/2/14.xliff', $download->getUrl());
        $this->assertEquals('2019-09-20T10:31:21+00:00', $download->getExpireIn());
    }

    public function testCreateFineTuningJob(): void
    {
        $params = [
            'trainingOptions' => [
                'projectIds' => [123],
            ],
        ];

        $this->mockRequest([
            'path' => '/ai/prompts/2/fine-tuning/jobs',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => '{
              "data": {
                "identifier": "50fb3506-4127-4ba8-8296-f97dc7e3e0c3",
                "status": "finished",
                "progress": 100,
                "attributes": {
                  "dryRun": false,
                  "aiPromptId": 789,
                  "baseModel": "gpt-4o-mini-2024-07-18",
                  "fineTunedModel": "ft:gpt-4o-mini-2024-07-18:2024-08-12:9vQgFOfp",
                  "trainedTokensCount": 5000,
                  "trainingDatasetUrl": "https://crowdin-tmp.s3.eu-central-1.amazonaws.com/72057531/ai_fine_tuning/0fc00e9e-3a80-49d1-a8cb-39c9a81c0ae2/training-dataset.jsonl",
                  "validationDatasetUrl": "https://crowdin-tmp.s3.eu-central-1.amazonaws.com/72057531/ai_fine_tuning/0fc00e9e-3a80-49d1-a8cb-39c9a81c0ae2/validation-dataset.jsonl",
                  "metadata": {
                    "cost": 25.50,
                    "costCurrency": "USD"
                  }
                },
                "createdAt": "2019-09-23T11:26:54+00:00",
                "updatedAt": "2019-09-23T11:26:54+00:00",
                "startedAt": "2019-09-23T11:26:54+00:00",
                "finishedAt": "2019-09-23T11:26:54+00:00"
              }
            }',
        ]);

        $job = $this->crowdin->ai->createFineTuningJob(2, $params);
        $this->assertInstanceOf(AiFineTuningJob::class, $job);
        $this->assertEquals('50fb3506-4127-4ba8-8296-f97dc7e3e0c3', $job->getIdentifier());
        $this->assertEquals('finished', $job->getStatus());
    }

    public function testGetFineTuningJob(): void
    {
        $this->mockRequest([
            'path' => '/ai/prompts/2/fine-tuning/jobs/50fb3506-4127-4ba8-8296-f97dc7e3e0c3',
            'method' => 'get',
            'response' => '{
              "data": {
                "identifier": "50fb3506-4127-4ba8-8296-f97dc7e3e0c3",
                "status": "finished",
                "progress": 100,
                "attributes": {
                  "dryRun": true,
                  "aiPromptId": 0,
                  "baseModel": "gpt-4o-mini-2024-07-18",
                  "fineTunedModel": "ft:gpt-4o-mini-2024-07-18:2024-08-12:9vQgFOfp",
                  "trainedTokensCount": null,
                  "metadata": {
                    "cost": 0.0,
                    "costCurrency": "USD"
                  }
                },
                "createdAt": "2019-09-23T11:26:54+00:00",
                "updatedAt": "2019-09-23T11:26:54+00:00",
                "startedAt": "2019-09-23T11:26:54+00:00",
                "finishedAt": "2019-09-23T11:26:54+00:00"
              }
            }',
        ]);

        $job = $this->crowdin->ai->getFineTuningJob(2, '50fb3506-4127-4ba8-8296-f97dc7e3e0c3');
        $this->assertInstanceOf(AiFineTuningJob::class, $job);
        $this->assertEquals('finished', $job->getStatus());
        $this->assertEquals(100, $job->getProgress());
        $this->assertIsArray($job->getAttributes());
        $this->assertEquals('2019-09-23T11:26:54+00:00', $job->getCreatedAt());
        $this->assertEquals('2019-09-23T11:26:54+00:00', $job->getUpdatedAt());
        $this->assertEquals('2019-09-23T11:26:54+00:00', $job->getStartedAt());
        $this->assertEquals('2019-09-23T11:26:54+00:00', $job->getFinishedAt());
    }

    public function testListFineTuningJobs(): void
    {
        $this->mockRequest([
            'path' => '/ai/prompts/fine-tuning/jobs',
            'method' => 'get',
            'response' => '{
              "data": [
                {
                  "data": {
                    "identifier": "50fb3506-4127-4ba8-8296-f97dc7e3e0c3",
                    "status": "finished",
                    "progress": 100,
                    "attributes": {
                      "dryRun": false,
                      "aiPromptId": 0,
                      "baseModel": "gpt-4o-mini-2024-07-18",
                      "fineTunedModel": "ft:gpt-4o-mini-2024-07-18:2024-08-12:9vQgFOfp",
                      "trainedTokensCount": null,
                      "metadata": {
                        "cost": 0.0,
                        "costCurrency": "USD"
                      }
                    },
                    "createdAt": "2019-09-23T11:26:54+00:00",
                    "updatedAt": "2019-09-23T11:26:54+00:00",
                    "startedAt": "2019-09-23T11:26:54+00:00",
                    "finishedAt": "2019-09-23T11:26:54+00:00"
                  }
                }
              ],
              "pagination": {"offset": 0, "limit": 25}
            }',
        ]);

        $jobs = $this->crowdin->ai->listFineTuningJobs();
        $this->assertInstanceOf(ModelCollection::class, $jobs);
        $this->assertInstanceOf(AiFineTuningJob::class, $jobs[0]);
        $this->assertEquals('50fb3506-4127-4ba8-8296-f97dc7e3e0c3', $jobs[0]->getIdentifier());
    }

    public function testListFineTuningJobEvents(): void
    {
        $this->mockRequest([
            'path' => '/ai/prompts/2/fine-tuning/jobs/50fb3506-4127-4ba8-8296-f97dc7e3e0c3/events',
            'method' => 'get',
            'response' => '{
              "data": [
                {
                  "data": {
                    "id": "ftevent-0HOW0hqwQ7G1b70qOC8S7UsT",
                    "type": "message",
                    "message": "Created fine-tuning job: ftjob-EhnfVT9MnddMBLfjMcme71if",
                    "data": null,
                    "createdAt": "2019-09-23T11:26:54+00:00"
                  }
                },
                {
                  "data": {
                    "id": "ftevent-0HOW0hqwQ7G1b70qOC8S7UsT",
                    "type": "metrics",
                    "message": null,
                    "data": {
                      "step": 135,
                      "totalSteps": 135,
                      "trainingLoss": 0.0031,
                      "validationLoss": 0.0449,
                      "fullValidationLoss": 0.0275
                    },
                    "createdAt": "2019-09-23T11:26:54+00:00"
                  }
                }
              ],
              "pagination": {"offset": 0, "limit": 25}
            }',
        ]);

        $events = $this->crowdin->ai->listFineTuningJobEvents(2, '50fb3506-4127-4ba8-8296-f97dc7e3e0c3');
        $this->assertInstanceOf(ModelCollection::class, $events);
        $this->assertInstanceOf(AiFineTuningEvent::class, $events[0]);
        $this->assertEquals('ftevent-0HOW0hqwQ7G1b70qOC8S7UsT', $events[0]->getId());
        $this->assertEquals('Created fine-tuning job: ftjob-EhnfVT9MnddMBLfjMcme71if', $events[0]->getMessage());
        $this->assertEquals('2019-09-23T11:26:54+00:00', $events[0]->getCreatedAt());
        $this->assertIsArray($events[1]->getMetrics());
    }

    public function testListProviders(): void
    {
        $this->mockRequest([
            'path' => '/ai/providers',
            'method' => 'get',
            'response' => '{
              "data": [
                {
                  "data": {
                    "id": 2,
                    "name": "OpenAI",
                    "type": "open_ai",
                    "credentials": {"apiKey": "sk-..."},
                    "config": {
                      "actionRules": [
                        {
                          "action": "pre_translate",
                          "availableAiModelIds": ["gpt-5.4"]
                        }
                      ]
                    },
                    "isEnabled": true,
                    "useSystemCredentials": false,
                    "createdAt": "2019-09-20T11:11:05+00:00",
                    "updatedAt": "2019-09-20T12:22:20+00:00",
                    "promptsCount": 42
                  }
                }
              ],
              "pagination": {"offset": 0, "limit": 25}
            }',
        ]);

        $providers = $this->crowdin->ai->listProviders();
        $this->assertInstanceOf(ModelCollection::class, $providers);
        $this->assertInstanceOf(AiProvider::class, $providers[0]);
        $this->assertEquals(2, $providers[0]->getId());
        $this->assertEquals('OpenAI', $providers[0]->getName());
    }

    public function testCreateProvider(): void
    {
        $params = [
            'name' => 'OpenAI',
            'type' => 'open_ai',
            'credentials' => ['apiKey' => 'sk-...'],
            'isEnabled' => true,
            'useSystemCredentials' => false,
        ];

        $this->mockRequest([
            'path' => '/ai/providers',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => '{
              "data": {
                "id": 2,
                "name": "OpenAI",
                "type": "open_ai",
                "credentials": {"apiKey": "sk-..."},
                "config": {},
                "isEnabled": true,
                "useSystemCredentials": false,
                "createdAt": "2019-09-20T11:11:05+00:00",
                "updatedAt": "2019-09-20T12:22:20+00:00",
                "promptsCount": 42
              }
            }',
        ]);

        $provider = $this->crowdin->ai->createProvider($params);
        $this->assertInstanceOf(AiProvider::class, $provider);
        $this->assertEquals(2, $provider->getId());
        $this->assertEquals('OpenAI', $provider->getName());
    }

    public function testGetProvider(): void
    {
        $this->mockRequest([
            'path' => '/ai/providers/2',
            'method' => 'get',
            'response' => '{
              "data": {
                "id": 2,
                "name": "OpenAI",
                "type": "open_ai",
                "credentials": {"apiKey": "string"},
                "config": {
                  "actionRules": [
                    {
                      "action": "pre_translate",
                      "availableAiModelIds": ["gpt-5.4"]
                    }
                  ]
                },
                "isEnabled": true,
                "useSystemCredentials": false,
                "createdAt": "2019-09-20T11:11:05+00:00",
                "updatedAt": "2019-09-20T12:22:20+00:00",
                "promptsCount": 42
              }
            }',
        ]);

        $provider = $this->crowdin->ai->getProvider(2);
        $this->assertInstanceOf(AiProvider::class, $provider);
        $this->assertEquals(2, $provider->getId());
        $this->assertFalse($provider->isUseSystemCredentials());
        $this->assertEquals(42, $provider->getPromptsCount());
        $this->assertEquals(['apiKey' => 'string'], $provider->getCredentials());
        $this->assertIsArray($provider->getConfig());
        $this->assertTrue($provider->isEnabled());
        $this->assertEquals('2019-09-20T11:11:05+00:00', $provider->getCreatedAt());
        $this->assertEquals('2019-09-20T12:22:20+00:00', $provider->getUpdatedAt());
    }

    public function testDeleteProvider(): void
    {
        $this->mockRequest([
            'path' => '/ai/providers/2',
            'method' => 'delete',
            'response' => '',
        ]);

        $this->crowdin->ai->deleteProvider(2);
    }

    public function testListProviderModels(): void
    {
        $this->mockRequest([
            'path' => '/ai/providers/2/models',
            'method' => 'get',
            'response' => '{
              "data": [
                {
                  "data": {
                    "id": "gpt-5.4",
                    "provider": "open_ai",
                    "providerName": "OpenAI",
                    "providerId": 1
                  }
                }
              ],
              "pagination": {"offset": 0, "limit": 25}
            }',
        ]);

        $models = $this->crowdin->ai->listProviderModels(2);
        $this->assertInstanceOf(ModelCollection::class, $models);
        $this->assertInstanceOf(AiProviderModel::class, $models[0]);
        $this->assertEquals('gpt-5.4', $models[0]->getId());
        $this->assertEquals('open_ai', $models[0]->getProvider());
        $this->assertEquals('OpenAI', $models[0]->getProviderName());
    }

    public function testCreateProviderChatCompletion(): void
    {
        $params = [
            'model' => 'gpt-4o',
            'messages' => [
                ['role' => 'user', 'content' => 'Hello'],
            ],
        ];

        $this->mockRequest([
            'path' => '/ai/providers/2/chat/completions',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => '{
              "data": {
                "id": "chatcmpl-123",
                "object": "chat.completion",
                "model": "gpt-4o",
                "choices": [{"message": {"role": "assistant", "content": "Hi!"}}]
              }
            }',
        ]);

        $completion = $this->crowdin->ai->createProviderChatCompletion(2, $params);
        $this->assertInstanceOf(AiProxyChatCompletion::class, $completion);
    }

    public function testGenerateReport(): void
    {
        $params = [
            'type' => 'tokens-usage-raw-data',
            'schema' => [
                'dateFrom' => '2024-01-23T07:00:14+00:00',
                'dateTo' => '2024-09-27T07:00:14+00:00',
                'format' => 'json',
                'projectIds' => [22],
                'promptIds' => [18],
                'userIds' => [1],
            ],
        ];

        $this->mockRequest([
            'path' => '/ai/reports',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => '{
              "data": {
                "identifier": "50fb3506-4127-4ba8-8296-f97dc7e3e0c3",
                "status": "finished",
                "progress": 100,
                "attributes": {
                  "format": "json",
                  "reportType": "tokens-usage-raw-data",
                  "schema": {}
                },
                "createdAt": "2024-01-23T11:26:54+00:00",
                "updatedAt": "2024-09-23T11:26:54+00:00",
                "startedAt": "2024-05-23T11:26:54+00:00",
                "finishedAt": "2024-05-23T11:26:54+00:00"
              }
            }',
        ]);

        $report = $this->crowdin->ai->generateReport($params);
        $this->assertInstanceOf(AiReport::class, $report);
        $this->assertEquals('50fb3506-4127-4ba8-8296-f97dc7e3e0c3', $report->getIdentifier());
        $this->assertEquals('finished', $report->getStatus());
    }

    public function testGetReport(): void
    {
        $this->mockRequest([
            'path' => '/ai/reports/50fb3506-4127-4ba8-8296-f97dc7e3e0c3',
            'method' => 'get',
            'response' => '{
              "data": {
                "identifier": "50fb3506-4127-4ba8-8296-f97dc7e3e0c3",
                "status": "finished",
                "progress": 100,
                "attributes": {
                  "format": "json",
                  "reportType": "tokens-usage-raw-data",
                  "schema": {}
                },
                "createdAt": "2024-01-23T11:26:54+00:00",
                "updatedAt": "2024-09-23T11:26:54+00:00",
                "startedAt": "2024-05-23T11:26:54+00:00",
                "finishedAt": "2024-05-23T11:26:54+00:00"
              }
            }',
        ]);

        $report = $this->crowdin->ai->getReport('50fb3506-4127-4ba8-8296-f97dc7e3e0c3');
        $this->assertInstanceOf(AiReport::class, $report);
        $this->assertEquals('finished', $report->getStatus());
        $this->assertEquals(100, $report->getProgress());
        $this->assertIsArray($report->getAttributes());
        $this->assertEquals('2024-01-23T11:26:54+00:00', $report->getCreatedAt());
        $this->assertEquals('2024-09-23T11:26:54+00:00', $report->getUpdatedAt());
        $this->assertEquals('2024-05-23T11:26:54+00:00', $report->getStartedAt());
        $this->assertEquals('2024-05-23T11:26:54+00:00', $report->getFinishedAt());
    }

    public function testDownloadReport(): void
    {
        $this->mockRequest([
            'path' => '/ai/reports/50fb3506-4127-4ba8-8296-f97dc7e3e0c3/download',
            'method' => 'get',
            'response' => '{
              "data": {
                "url": "https://production-enterprise-importer.downloads.crowdin.com/992000002/2/14.xliff",
                "expireIn": "2019-09-20T10:31:21+00:00"
              }
            }',
        ]);

        $download = $this->crowdin->ai->downloadReport('50fb3506-4127-4ba8-8296-f97dc7e3e0c3');
        $this->assertInstanceOf(DownloadFile::class, $download);
        $this->assertEquals('https://production-enterprise-importer.downloads.crowdin.com/992000002/2/14.xliff', $download->getUrl());
        $this->assertEquals('2019-09-20T10:31:21+00:00', $download->getExpireIn());
    }

    public function testGetSettings(): void
    {
        $this->mockRequest([
            'path' => '/ai/settings',
            'method' => 'get',
            'response' => '{
              "data": {
                "preTranslationAiPromptId": 2,
                "editorSuggestionAiPromptId": 5,
                "qaCheckActionAiPromptId": 8,
                "contextReviewAiPromptId": 11
              }
            }',
        ]);

        $settings = $this->crowdin->ai->getSettings();
        $this->assertInstanceOf(AiSettings::class, $settings);
        $this->assertEquals(2, $settings->getPreTranslationAiPromptId());
        $this->assertEquals(5, $settings->getEditorSuggestionAiPromptId());
        $this->assertEquals(8, $settings->getQaCheckActionAiPromptId());
        $this->assertEquals(11, $settings->getContextReviewAiPromptId());
    }

    public function testListCustomPlaceholders(): void
    {
        $this->mockRequest([
            'path' => '/ai/settings/custom-placeholders',
            'method' => 'get',
            'response' => '{
              "data": [
                {
                  "data": {
                    "id": 2,
                    "description": "Product description",
                    "placeholder": "%custom:productDescription%",
                    "value": "The product is the professional consulting service that transform challenges into opportunities.",
                    "createdAt": "2019-09-20T11:11:05+00:00",
                    "updatedAt": "2019-09-20T12:22:20+00:00"
                  }
                }
              ],
              "pagination": {"offset": 0, "limit": 25}
            }',
        ]);

        $placeholders = $this->crowdin->ai->listCustomPlaceholders();
        $this->assertInstanceOf(ModelCollection::class, $placeholders);
        $this->assertInstanceOf(AiCustomPlaceholder::class, $placeholders[0]);
        $this->assertEquals(2, $placeholders[0]->getId());
        $this->assertEquals('%custom:productDescription%', $placeholders[0]->getPlaceholder());
    }

    public function testCreateCustomPlaceholder(): void
    {
        $params = [
            'description' => 'Product description',
            'placeholder' => '%custom:productDescription%',
            'value' => 'The product is the professional consulting service that transform challenges into opportunities.',
        ];

        $this->mockRequest([
            'path' => '/ai/settings/custom-placeholders',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => '{
              "data": {
                "id": 2,
                "description": "Product description",
                "placeholder": "%custom:productDescription%",
                "value": "The product is the professional consulting service that transform challenges into opportunities.",
                "createdAt": "2019-09-20T11:11:05+00:00",
                "updatedAt": "2019-09-20T12:22:20+00:00"
              }
            }',
        ]);

        $placeholder = $this->crowdin->ai->createCustomPlaceholder($params);
        $this->assertInstanceOf(AiCustomPlaceholder::class, $placeholder);
        $this->assertEquals(2, $placeholder->getId());
        $this->assertEquals('Product description', $placeholder->getDescription());
    }

    public function testGetCustomPlaceholder(): void
    {
        $this->mockRequest([
            'path' => '/ai/settings/custom-placeholders/2',
            'method' => 'get',
            'response' => '{
              "data": {
                "id": 2,
                "description": "Product description",
                "placeholder": "%custom:productDescription%",
                "value": "The product is the professional consulting service that transform challenges into opportunities.",
                "createdAt": "2019-09-20T11:11:05+00:00",
                "updatedAt": "2019-09-20T12:22:20+00:00"
              }
            }',
        ]);

        $placeholder = $this->crowdin->ai->getCustomPlaceholder(2);
        $this->assertInstanceOf(AiCustomPlaceholder::class, $placeholder);
        $this->assertEquals(
            'The product is the professional consulting service that transform challenges into opportunities.',
            $placeholder->getValue()
        );
        $this->assertEquals('2019-09-20T11:11:05+00:00', $placeholder->getCreatedAt());
        $this->assertEquals('2019-09-20T12:22:20+00:00', $placeholder->getUpdatedAt());
    }

    public function testDeleteCustomPlaceholder(): void
    {
        $this->mockRequest([
            'path' => '/ai/settings/custom-placeholders/2',
            'method' => 'delete',
            'response' => '',
        ]);

        $this->crowdin->ai->deleteCustomPlaceholder(2);
    }

    public function testListSnippets(): void
    {
        $this->mockRequest([
            'path' => '/ai/settings/snippets',
            'method' => 'get',
            'response' => '{
              "data": [
                {
                  "data": {
                    "id": 2,
                    "description": "Product description",
                    "placeholder": "%custom:productDescription%",
                    "value": "The product is the professional consulting service that transform challenges into opportunities.",
                    "createdAt": "2019-09-20T11:11:05+00:00",
                    "updatedAt": "2019-09-20T12:22:20+00:00"
                  }
                }
              ],
              "pagination": {"offset": 0, "limit": 25}
            }',
        ]);

        $snippets = $this->crowdin->ai->listSnippets();
        $this->assertInstanceOf(ModelCollection::class, $snippets);
        $this->assertInstanceOf(AiSnippet::class, $snippets[0]);
        $this->assertEquals(2, $snippets[0]->getId());
        $this->assertEquals('%custom:productDescription%', $snippets[0]->getPlaceholder());
    }

    public function testCreateSnippet(): void
    {
        $params = [
            'description' => 'Product description',
            'placeholder' => '%custom:productDescription%',
            'value' => 'The product is the professional consulting service that transform challenges into opportunities.',
        ];

        $this->mockRequest([
            'path' => '/ai/settings/snippets',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => '{
              "data": {
                "id": 2,
                "description": "Product description",
                "placeholder": "%custom:productDescription%",
                "value": "The product is the professional consulting service that transform challenges into opportunities.",
                "createdAt": "2019-09-20T11:11:05+00:00",
                "updatedAt": "2019-09-20T12:22:20+00:00"
              }
            }',
        ]);

        $snippet = $this->crowdin->ai->createSnippet($params);
        $this->assertInstanceOf(AiSnippet::class, $snippet);
        $this->assertEquals(2, $snippet->getId());
        $this->assertEquals('Product description', $snippet->getDescription());
    }

    public function testGetSnippet(): void
    {
        $this->mockRequest([
            'path' => '/ai/settings/snippets/2',
            'method' => 'get',
            'response' => '{
              "data": {
                "id": 2,
                "description": "Product description",
                "placeholder": "%custom:productDescription%",
                "value": "The product is the professional consulting service that transform challenges into opportunities.",
                "createdAt": "2019-09-20T11:11:05+00:00",
                "updatedAt": "2019-09-20T12:22:20+00:00"
              }
            }',
        ]);

        $snippet = $this->crowdin->ai->getSnippet(2);
        $this->assertInstanceOf(AiSnippet::class, $snippet);
        $this->assertEquals(
            'The product is the professional consulting service that transform challenges into opportunities.',
            $snippet->getValue()
        );
        $this->assertEquals('2019-09-20T11:11:05+00:00', $snippet->getCreatedAt());
        $this->assertEquals('2019-09-20T12:22:20+00:00', $snippet->getUpdatedAt());
    }

    public function testDeleteSnippet(): void
    {
        $this->mockRequest([
            'path' => '/ai/settings/snippets/2',
            'method' => 'delete',
            'response' => '',
        ]);

        $this->crowdin->ai->deleteSnippet(2);
    }

    public function testUpdatePrompt(): void
    {
        $prompt = new AiPrompt([
            'id' => 2,
            'name' => 'Pre-translate prompt',
            'action' => 'pre_translate',
            'aiProviderId' => 2,
            'aiModelId' => 'gpt-5.4',
            'isEnabled' => true,
            'enabledProjectIds' => [1],
            'config' => [],
            'promptPreview' => null,
            'isFineTuningAvailable' => true,
            'createdBy' => 123,
            'updatedBy' => 456,
            'lastUsedBy' => 789,
            'lastUsedAt' => '2019-09-25T14:30:00+00:00',
            'usageCount' => 42,
            'createdAt' => '2019-09-20T11:11:05+00:00',
            'updatedAt' => '2019-09-20T12:22:20+00:00',
        ]);
        $prompt->setName('Updated prompt');
        $prompt->setAction('translate');
        $prompt->setAiProviderId(3);
        $prompt->setAiModelId('gpt-4o');
        $prompt->setEnabledProjectIds([2, 3]);
        $prompt->setConfig(['mode' => 'advanced']);

        $this->mockRequestPatch(
            '/ai/prompts/2',
            json_encode([
                'data' => [
                    'id' => 2,
                    'name' => 'Updated prompt',
                    'action' => 'translate',
                    'aiProviderId' => 3,
                    'aiModelId' => 'gpt-4o',
                    'isEnabled' => true,
                    'enabledProjectIds' => [2, 3],
                    'config' => ['mode' => 'advanced'],
                    'promptPreview' => null,
                    'isFineTuningAvailable' => true,
                    'createdBy' => 123,
                    'updatedBy' => 456,
                    'lastUsedBy' => 789,
                    'lastUsedAt' => '2019-09-25T14:30:00+00:00',
                    'usageCount' => 42,
                    'createdAt' => '2019-09-20T11:11:05+00:00',
                    'updatedAt' => '2019-09-20T12:22:20+00:00',
                ],
            ])
        );

        $updated = $this->crowdin->ai->updatePrompt($prompt);
        $this->assertInstanceOf(AiPrompt::class, $updated);
        $this->assertEquals(2, $updated->getId());
        $this->assertEquals('Updated prompt', $updated->getName());
        $this->assertEquals('gpt-4o', $updated->getAiModelId());
    }

    public function testUpdateProvider(): void
    {
        $provider = new AiProvider([
            'id' => 2,
            'name' => 'OpenAI',
            'type' => 'open_ai',
            'credentials' => ['apiKey' => 'sk-...'],
            'config' => [],
            'isEnabled' => true,
            'useSystemCredentials' => false,
            'createdAt' => '2019-09-20T11:11:05+00:00',
            'updatedAt' => '2019-09-20T12:22:20+00:00',
            'promptsCount' => 42,
        ]);
        $provider->setName('Azure OpenAI');
        $provider->setType('azure_open_ai');
        $provider->setCredentials(['apiKey' => 'new-key']);
        $provider->setConfig(['actionRules' => []]);
        $provider->setIsEnabled(false);
        $provider->setUseSystemCredentials(true);

        $this->mockRequestPatch(
            '/ai/providers/2',
            json_encode([
                'data' => [
                    'id' => 2,
                    'name' => 'Azure OpenAI',
                    'type' => 'azure_open_ai',
                    'credentials' => ['apiKey' => 'new-key'],
                    'config' => ['actionRules' => []],
                    'isEnabled' => false,
                    'useSystemCredentials' => true,
                    'createdAt' => '2019-09-20T11:11:05+00:00',
                    'updatedAt' => '2019-09-20T12:22:20+00:00',
                    'promptsCount' => 42,
                ],
            ])
        );

        $updated = $this->crowdin->ai->updateProvider($provider);
        $this->assertInstanceOf(AiProvider::class, $updated);
        $this->assertEquals(2, $updated->getId());
        $this->assertEquals('Azure OpenAI', $updated->getName());
    }

    public function testUpdateSettings(): void
    {
        $settings = new AiSettings([
            'preTranslationAiPromptId' => 2,
            'editorSuggestionAiPromptId' => 5,
            'qaCheckActionAiPromptId' => 8,
            'contextReviewAiPromptId' => 11,
        ]);
        $settings->setPreTranslationAiPromptId(3);
        $settings->setEditorSuggestionAiPromptId(6);
        $settings->setQaCheckActionAiPromptId(9);
        $settings->setContextReviewAiPromptId(12);

        $this->mockRequestPatch(
            '/ai/settings',
            json_encode([
                'data' => [
                    'preTranslationAiPromptId' => 3,
                    'editorSuggestionAiPromptId' => 6,
                    'qaCheckActionAiPromptId' => 9,
                    'contextReviewAiPromptId' => 12,
                ],
            ])
        );

        $updated = $this->crowdin->ai->updateSettings($settings);
        $this->assertInstanceOf(AiSettings::class, $updated);
        $this->assertEquals(3, $updated->getPreTranslationAiPromptId());
        $this->assertEquals(6, $updated->getEditorSuggestionAiPromptId());
        $this->assertEquals(9, $updated->getQaCheckActionAiPromptId());
        $this->assertEquals(12, $updated->getContextReviewAiPromptId());
    }

    public function testUpdateCustomPlaceholder(): void
    {
        $placeholder = new AiCustomPlaceholder([
            'id' => 2,
            'description' => 'Product description',
            'placeholder' => '%custom:productDescription%',
            'value' => 'The product is the professional consulting service that transform challenges into opportunities.',
            'createdAt' => '2019-09-20T11:11:05+00:00',
            'updatedAt' => '2019-09-20T12:22:20+00:00',
        ]);
        $placeholder->setDescription('Updated description');
        $placeholder->setPlaceholder('%custom:updatedDescription%');
        $placeholder->setValue('Updated value.');

        $this->mockRequestPatch(
            '/ai/settings/custom-placeholders/2',
            json_encode([
                'data' => [
                    'id' => 2,
                    'description' => 'Updated description',
                    'placeholder' => '%custom:updatedDescription%',
                    'value' => 'Updated value.',
                    'createdAt' => '2019-09-20T11:11:05+00:00',
                    'updatedAt' => '2019-09-20T12:22:20+00:00',
                ],
            ])
        );

        $updated = $this->crowdin->ai->updateCustomPlaceholder($placeholder);
        $this->assertInstanceOf(AiCustomPlaceholder::class, $updated);
        $this->assertEquals('Updated description', $updated->getDescription());
        $this->assertEquals('%custom:updatedDescription%', $updated->getPlaceholder());
        $this->assertEquals('Updated value.', $updated->getValue());
    }

    public function testUpdateSnippet(): void
    {
        $snippet = new AiSnippet([
            'id' => 2,
            'description' => 'Product description',
            'placeholder' => '%custom:productDescription%',
            'value' => 'The product is the professional consulting service that transform challenges into opportunities.',
            'createdAt' => '2019-09-20T11:11:05+00:00',
            'updatedAt' => '2019-09-20T12:22:20+00:00',
        ]);
        $snippet->setDescription('Updated description');
        $snippet->setPlaceholder('%custom:updatedDescription%');
        $snippet->setValue('Updated value.');

        $this->mockRequestPatch(
            '/ai/settings/snippets/2',
            json_encode([
                'data' => [
                    'id' => 2,
                    'description' => 'Updated description',
                    'placeholder' => '%custom:updatedDescription%',
                    'value' => 'Updated value.',
                    'createdAt' => '2019-09-20T11:11:05+00:00',
                    'updatedAt' => '2019-09-20T12:22:20+00:00',
                ],
            ])
        );

        $updated = $this->crowdin->ai->updateSnippet($snippet);
        $this->assertInstanceOf(AiSnippet::class, $updated);
        $this->assertEquals('Updated description', $updated->getDescription());
        $this->assertEquals('%custom:updatedDescription%', $updated->getPlaceholder());
        $this->assertEquals('Updated value.', $updated->getValue());
    }
}
