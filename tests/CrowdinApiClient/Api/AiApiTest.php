<?php

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\AiFileTranslation;
use CrowdinApiClient\Model\AiFineTuningDataset;
use CrowdinApiClient\Model\AiFineTuningEvent;
use CrowdinApiClient\Model\AiFineTuningJob;
use CrowdinApiClient\Model\AiMemberUsage;
use CrowdinApiClient\Model\AiPrompt;
use CrowdinApiClient\Model\AiPromptCompletion;
use CrowdinApiClient\Model\AiProvider;
use CrowdinApiClient\Model\AiProviderModel;
use CrowdinApiClient\Model\AiProxyChatCompletion;
use CrowdinApiClient\Model\AiReport;
use CrowdinApiClient\Model\AiRequestLog;
use CrowdinApiClient\Model\AiRequestLogExport;
use CrowdinApiClient\Model\AiSettings;
use CrowdinApiClient\Model\AiSnippet;
use CrowdinApiClient\Model\AiSupportedModel;
use CrowdinApiClient\Model\AiTranslation;
use CrowdinApiClient\Model\DownloadFile;
use CrowdinApiClient\Model\ProjectAiSettings;
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
            'path' => '/users/1/ai/translate',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => json_encode([
                'data' => [
                    'sourceLanguageId' => 'en',
                    'targetLanguageId' => 'uk',
                    'translations' => ['Перекладений текст 1', 'Перекладений текст 2'],
                ],
            ]),
        ]);

        $aiTranslation = $this->crowdin->ai->translateStrings(1, $params);

        $this->assertInstanceOf(AiTranslation::class, $aiTranslation);
        $this->assertEquals('en', $aiTranslation->getSourceLanguageId());
        $this->assertEquals('uk', $aiTranslation->getTargetLanguageId());
        $this->assertEquals(['Перекладений текст 1', 'Перекладений текст 2'], $aiTranslation->getTranslations());
    }

    private function fileTranslationResponse(): string
    {
        return json_encode([
            'data' => [
                'identifier' => '50fb3506-4127-4ba8-8296-f97dc7e3e0c3',
                'status' => 'finished',
                'progress' => 100,
                'attributes' => [
                    'stage' => 'translate',
                    'error' => null,
                    'downloadName' => 'file.pdf',
                    'sourceLanguageId' => 'en',
                    'targetLanguageId' => 'uk',
                    'originalFileName' => 'Sample_Chrome.json',
                    'detectedType' => 'chrome',
                    'parserVersion' => 2,
                ],
                'createdAt' => '2026-01-23T11:26:54+00:00',
                'updatedAt' => '2026-01-23T11:26:54+00:00',
                'startedAt' => '2026-01-23T11:26:54+00:00',
                'finishedAt' => '2026-01-23T11:26:54+00:00',
            ],
        ]);
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
            'path' => '/users/1/ai/file-translations',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => $this->fileTranslationResponse(),
        ]);

        $fileTranslation = $this->crowdin->ai->createFileTranslation(1, $params);

        $this->assertInstanceOf(AiFileTranslation::class, $fileTranslation);
        $this->assertEquals('50fb3506-4127-4ba8-8296-f97dc7e3e0c3', $fileTranslation->getIdentifier());
        $this->assertEquals('finished', $fileTranslation->getStatus());
        $this->assertEquals(100, $fileTranslation->getProgress());
        $this->assertEquals('uk', $fileTranslation->getAttributes()['targetLanguageId']);
    }

    public function testGetFileTranslation(): void
    {
        $this->mockRequest([
            'path' => '/users/1/ai/file-translations/50fb3506-4127-4ba8-8296-f97dc7e3e0c3',
            'method' => 'get',
            'response' => $this->fileTranslationResponse(),
        ]);

        $fileTranslation = $this->crowdin->ai->getFileTranslation(1, '50fb3506-4127-4ba8-8296-f97dc7e3e0c3');

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
            'path' => '/users/1/ai/file-translations/50fb3506-4127-4ba8-8296-f97dc7e3e0c3',
            'method' => 'delete',
            'response' => '',
        ]);

        $this->crowdin->ai->deleteFileTranslation(1, '50fb3506-4127-4ba8-8296-f97dc7e3e0c3');
    }

    private function downloadFileResponse(): string
    {
        return json_encode([
            'data' => [
                'url' => 'https://production-enterprise-importer.downloads.crowdin.com/992000002/2/14.xliff',
                'expireIn' => '2019-09-20T10:31:21+00:00',
            ],
        ]);
    }

    public function testDownloadFileTranslation(): void
    {
        $this->mockRequest([
            'path' => '/users/1/ai/file-translations/50fb3506-4127-4ba8-8296-f97dc7e3e0c3/download',
            'method' => 'get',
            'response' => $this->downloadFileResponse(),
        ]);

        $downloadFile = $this->crowdin->ai->downloadFileTranslation(1, '50fb3506-4127-4ba8-8296-f97dc7e3e0c3');

        $this->assertInstanceOf(DownloadFile::class, $downloadFile);
        $this->assertEquals('https://production-enterprise-importer.downloads.crowdin.com/992000002/2/14.xliff', $downloadFile->getUrl());
        $this->assertEquals('2019-09-20T10:31:21+00:00', $downloadFile->getExpireIn());
    }

    public function testDownloadFileTranslationStrings(): void
    {
        $this->mockRequest([
            'path' => '/users/1/ai/file-translations/50fb3506-4127-4ba8-8296-f97dc7e3e0c3/translations',
            'method' => 'get',
            'response' => $this->downloadFileResponse(),
        ]);

        $downloadFile = $this->crowdin->ai->downloadFileTranslationStrings(1, '50fb3506-4127-4ba8-8296-f97dc7e3e0c3');

        $this->assertInstanceOf(DownloadFile::class, $downloadFile);
        $this->assertEquals('https://production-enterprise-importer.downloads.crowdin.com/992000002/2/14.xliff', $downloadFile->getUrl());
        $this->assertEquals('2019-09-20T10:31:21+00:00', $downloadFile->getExpireIn());
    }

    public function testListPrompts(): void
    {
        $this->mockRequest([
            'path' => '/users/1/ai/prompts',
            'method' => 'get',
            'response' => json_encode([
                'data' => [
                    [
                        'data' => [
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
                        ],
                    ],
                ],
                'pagination' => [
                    'offset' => 0,
                    'limit' => 25,
                ],
            ]),
        ]);

        $prompts = $this->crowdin->ai->listPrompts(1);

        $this->assertInstanceOf(ModelCollection::class, $prompts);
        $this->assertInstanceOf(AiPrompt::class, $prompts[0]);
        $this->assertEquals(2, $prompts[0]->getId());
        $this->assertEquals('Pre-translate prompt', $prompts[0]->getName());
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
            'path' => '/users/1/ai/prompts',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => json_encode([
                'data' => [
                    'id' => 2,
                    'name' => 'Pre-translate prompt',
                    'action' => 'pre_translate',
                    'aiProviderId' => 2,
                    'aiModelId' => 'gpt-5.4',
                    'isEnabled' => true,
                    'enabledProjectIds' => [1],
                    'config' => [
                        'mode' => 'basic',
                    ],
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
            ]),
        ]);

        $prompt = $this->crowdin->ai->createPrompt(1, $params);

        $this->assertInstanceOf(AiPrompt::class, $prompt);
        $this->assertEquals(2, $prompt->getId());
        $this->assertEquals('Pre-translate prompt', $prompt->getName());
        $this->assertTrue($prompt->isEnabled());
    }

    public function testGetPrompt(): void
    {
        $this->mockRequest([
            'path' => '/users/1/ai/prompts/2',
            'method' => 'get',
            'response' => json_encode([
                'data' => [
                    'id' => 2,
                    'name' => 'Pre-translate prompt',
                    'action' => 'pre_translate',
                    'aiProviderId' => 2,
                    'aiModelId' => 'gpt-5.4',
                    'isEnabled' => true,
                    'enabledProjectIds' => [1],
                    'config' => [
                        'mode' => 'basic',
                        'snippets' => ['%custom:companyDescription%'],
                        'otherLanguageTranslations' => [
                            'isEnabled' => true,
                            'languageIds' => ['uk'],
                        ],
                        'glossaryTerms' => true,
                        'tmSuggestions' => true,
                        'fileContext' => true,
                        'generateFileSummary' => true,
                        'screenshots' => true,
                        'projectContext' => true,
                        'siblingsStrings' => true,
                        'retryOnQaIssues' => true,
                    ],
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
            ]),
        ]);

        $prompt = $this->crowdin->ai->getPrompt(1, 2);

        $this->assertInstanceOf(AiPrompt::class, $prompt);
        $this->assertEquals(2, $prompt->getId());
        $this->assertEquals(2, $prompt->getAiProviderId());
        $this->assertEquals('gpt-5.4', $prompt->getAiModelId());
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
            'path' => '/users/1/ai/prompts/2',
            'method' => 'delete',
            'response' => '',
        ]);

        $this->crowdin->ai->deletePrompt(1, 2);
    }

    public function testClonePrompt(): void
    {
        $params = [
            'name' => 'Pre-translate prompt',
        ];

        $this->mockRequest([
            'path' => '/users/1/ai/prompts/2/clones',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => json_encode([
                'data' => [
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
                ],
            ]),
        ]);

        $cloned = $this->crowdin->ai->clonePrompt(1, 2, $params);

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
            'path' => '/users/1/ai/prompts/2/completions',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => $this->promptCompletionResponse(),
        ]);

        $completion = $this->crowdin->ai->createPromptCompletion(1, 2, $params);

        $this->assertInstanceOf(AiPromptCompletion::class, $completion);
        $this->assertEquals('50fb3506-4127-4ba8-8296-f97dc7e3e0c3', $completion->getIdentifier());
        $this->assertEquals('finished', $completion->getStatus());
        $this->assertEquals(['aiPromptId' => 38], $completion->getAttributes());
    }

    public function testGetPromptCompletion(): void
    {
        $this->mockRequest([
            'path' => '/users/1/ai/prompts/2/completions/50fb3506-4127-4ba8-8296-f97dc7e3e0c3',
            'method' => 'get',
            'response' => $this->promptCompletionResponse(),
        ]);

        $completion = $this->crowdin->ai->getPromptCompletion(1, 2, '50fb3506-4127-4ba8-8296-f97dc7e3e0c3');

        $this->assertInstanceOf(AiPromptCompletion::class, $completion);
        $this->assertEquals('finished', $completion->getStatus());
        $this->assertEquals(100, $completion->getProgress());
        $this->assertEquals('2019-09-23T11:26:54+00:00', $completion->getCreatedAt());
        $this->assertEquals('2019-09-23T11:26:54+00:00', $completion->getUpdatedAt());
        $this->assertEquals('2019-09-23T11:26:54+00:00', $completion->getStartedAt());
        $this->assertEquals('2019-09-23T11:26:54+00:00', $completion->getFinishedAt());
    }

    private function promptCompletionResponse(): string
    {
        return json_encode([
            'data' => [
                'identifier' => '50fb3506-4127-4ba8-8296-f97dc7e3e0c3',
                'status' => 'finished',
                'progress' => 100,
                'attributes' => [
                    'aiPromptId' => 38,
                ],
                'createdAt' => '2019-09-23T11:26:54+00:00',
                'updatedAt' => '2019-09-23T11:26:54+00:00',
                'startedAt' => '2019-09-23T11:26:54+00:00',
                'finishedAt' => '2019-09-23T11:26:54+00:00',
            ],
        ]);
    }

    public function testDeletePromptCompletion(): void
    {
        $this->mockRequest([
            'path' => '/users/1/ai/prompts/2/completions/50fb3506-4127-4ba8-8296-f97dc7e3e0c3',
            'method' => 'delete',
            'response' => '',
        ]);

        $this->crowdin->ai->deletePromptCompletion(1, 2, '50fb3506-4127-4ba8-8296-f97dc7e3e0c3');
    }

    public function testDownloadPromptCompletion(): void
    {
        $this->mockRequest([
            'path' => '/users/1/ai/prompts/2/completions/50fb3506-4127-4ba8-8296-f97dc7e3e0c3/download',
            'method' => 'get',
            'response' => $this->downloadFileResponse(),
        ]);

        $download = $this->crowdin->ai->downloadPromptCompletion(1, 2, '50fb3506-4127-4ba8-8296-f97dc7e3e0c3');

        $this->assertInstanceOf(DownloadFile::class, $download);
        $this->assertEquals('https://production-enterprise-importer.downloads.crowdin.com/992000002/2/14.xliff', $download->getUrl());
        $this->assertEquals('2019-09-20T10:31:21+00:00', $download->getExpireIn());
    }

    public function testListProviders(): void
    {
        $this->mockRequest([
            'path' => '/users/1/ai/providers',
            'method' => 'get',
            'response' => json_encode([
                'data' => [
                    [
                        'data' => [
                            'id' => 2,
                            'name' => 'OpenAI',
                            'type' => 'open_ai',
                            'credentials' => [
                                'apiKey' => 'sk-...',
                            ],
                            'config' => [
                                'actionRules' => [
                                    [
                                        'action' => 'pre_translate',
                                        'availableAiModelIds' => ['gpt-5.4'],
                                    ],
                                ],
                            ],
                            'isEnabled' => true,
                            'useSystemCredentials' => false,
                            'createdAt' => '2019-09-20T11:11:05+00:00',
                            'updatedAt' => '2019-09-20T12:22:20+00:00',
                            'promptsCount' => 42,
                        ],
                    ],
                ],
                'pagination' => [
                    'offset' => 0,
                    'limit' => 25,
                ],
            ]),
        ]);

        $providers = $this->crowdin->ai->listProviders(1);

        $this->assertInstanceOf(ModelCollection::class, $providers);
        $this->assertInstanceOf(AiProvider::class, $providers[0]);
        $this->assertEquals(2, $providers[0]->getId());
        $this->assertEquals('OpenAI', $providers[0]->getName());
        $this->assertEquals('open_ai', $providers[0]->getType());
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
            'path' => '/users/1/ai/providers',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => json_encode([
                'data' => [
                    'id' => 2,
                    'name' => 'OpenAI',
                    'type' => 'open_ai',
                    'credentials' => [
                        'apiKey' => 'sk-...',
                    ],
                    'config' => [],
                    'isEnabled' => true,
                    'useSystemCredentials' => false,
                    'createdAt' => '2019-09-20T11:11:05+00:00',
                    'updatedAt' => '2019-09-20T12:22:20+00:00',
                    'promptsCount' => 42,
                ],
            ]),
        ]);

        $provider = $this->crowdin->ai->createProvider(1, $params);

        $this->assertInstanceOf(AiProvider::class, $provider);
        $this->assertEquals(2, $provider->getId());
        $this->assertEquals('OpenAI', $provider->getName());
        $this->assertEquals(42, $provider->getPromptsCount());
    }

    public function testGetProvider(): void
    {
        $this->mockRequest([
            'path' => '/users/1/ai/providers/2',
            'method' => 'get',
            'response' => json_encode([
                'data' => [
                    'id' => 2,
                    'name' => 'OpenAI',
                    'type' => 'open_ai',
                    'credentials' => [
                        'apiKey' => 'string',
                    ],
                    'config' => [
                        'actionRules' => [
                            [
                                'action' => 'pre_translate',
                                'availableAiModelIds' => ['gpt-5.4'],
                            ],
                        ],
                    ],
                    'isEnabled' => true,
                    'useSystemCredentials' => false,
                    'createdAt' => '2019-09-20T11:11:05+00:00',
                    'updatedAt' => '2019-09-20T12:22:20+00:00',
                    'promptsCount' => 42,
                ],
            ]),
        ]);

        $provider = $this->crowdin->ai->getProvider(1, 2);

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
            'path' => '/users/1/ai/providers/2',
            'method' => 'delete',
            'response' => '',
        ]);

        $this->crowdin->ai->deleteProvider(1, 2);
    }

    public function testListProviderModels(): void
    {
        $this->mockRequest([
            'path' => '/users/1/ai/providers/2/models',
            'method' => 'get',
            'response' => json_encode([
                'data' => [
                    [
                        'data' => [
                            'id' => 'gpt-5.4',
                            'provider' => 'open_ai',
                            'providerName' => 'OpenAI',
                            'providerId' => 1,
                        ],
                    ],
                ],
                'pagination' => [
                    'offset' => 0,
                    'limit' => 25,
                ],
            ]),
        ]);

        $models = $this->crowdin->ai->listProviderModels(1, 2);

        $this->assertInstanceOf(ModelCollection::class, $models);
        $this->assertInstanceOf(AiProviderModel::class, $models[0]);
        $this->assertEquals('gpt-5.4', $models[0]->getId());
        $this->assertEquals('open_ai', $models[0]->getProvider());
        $this->assertEquals('OpenAI', $models[0]->getProviderName());
        $this->assertEquals(1, $models[0]->getProviderId());
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
            'path' => '/users/1/ai/providers/2/chat/completions',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => json_encode([
                'data' => [
                    'id' => 'chatcmpl-123',
                    'object' => 'chat.completion',
                    'model' => 'gpt-4o',
                    'choices' => [
                        [
                            'message' => [
                                'role' => 'assistant',
                                'content' => 'Hi!',
                            ],
                        ],
                    ],
                ],
            ]),
        ]);

        $completion = $this->crowdin->ai->createProviderChatCompletion(1, 2, $params);

        $this->assertInstanceOf(AiProxyChatCompletion::class, $completion);
    }

    private function reportResponse(): string
    {
        return json_encode([
            'data' => [
                'identifier' => '50fb3506-4127-4ba8-8296-f97dc7e3e0c3',
                'status' => 'finished',
                'progress' => 100,
                'attributes' => [
                    'format' => 'json',
                    'reportType' => 'tokens-usage-raw-data',
                    'schema' => [],
                ],
                'createdAt' => '2024-01-23T11:26:54+00:00',
                'updatedAt' => '2024-09-23T11:26:54+00:00',
                'startedAt' => '2024-05-23T11:26:54+00:00',
                'finishedAt' => '2024-05-23T11:26:54+00:00',
            ],
        ]);
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
            'path' => '/users/1/ai/reports',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => $this->reportResponse(),
        ]);

        $report = $this->crowdin->ai->generateReport(1, $params);

        $this->assertInstanceOf(AiReport::class, $report);
        $this->assertEquals('50fb3506-4127-4ba8-8296-f97dc7e3e0c3', $report->getIdentifier());
        $this->assertEquals('finished', $report->getStatus());
    }

    public function testGetReport(): void
    {
        $this->mockRequest([
            'path' => '/users/1/ai/reports/50fb3506-4127-4ba8-8296-f97dc7e3e0c3',
            'method' => 'get',
            'response' => $this->reportResponse(),
        ]);

        $report = $this->crowdin->ai->getReport(1, '50fb3506-4127-4ba8-8296-f97dc7e3e0c3');

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
            'path' => '/users/1/ai/reports/50fb3506-4127-4ba8-8296-f97dc7e3e0c3/download',
            'method' => 'get',
            'response' => $this->downloadFileResponse(),
        ]);

        $download = $this->crowdin->ai->downloadReport(1, '50fb3506-4127-4ba8-8296-f97dc7e3e0c3');

        $this->assertInstanceOf(DownloadFile::class, $download);
        $this->assertEquals('https://production-enterprise-importer.downloads.crowdin.com/992000002/2/14.xliff', $download->getUrl());
        $this->assertEquals('2019-09-20T10:31:21+00:00', $download->getExpireIn());
    }

    public function testListRequestLogs(): void
    {
        $this->mockRequest([
            'path' => '/users/1/ai/request-logs?requestId=9d3b1c4e-2f3a-4b5c-8d6e-7f8a9b0c1d2e&projectId=8&userId=42&aiProviderId=3&model=gpt-5.6-sol&sourceAction=ai_gateway&promptAction=pre_translate&statuses=pending%2Csuccess&systemCredentials=1&isAutoTriggered=0&tokenName=CI+token&oauthClientId=gpbccUFxAKZDrLm5Nq8t&createdAfter=2026-01-01T00%3A00%3A00%2B00%3A00&createdBefore=2026-01-02T00%3A00%3A00%2B00%3A00&limit=10&offset=20',
            'method' => 'get',
            'response' => json_encode([
                'data' => [
                    [
                        'data' => [
                            'id' => 12345,
                            'requestId' => '9d3b1c4e-2f3a-4b5c-8d6e-7f8a9b0c1d2e',
                            'createdAt' => '2026-01-01T10:00:00+00:00',
                            'status' => 'success',
                            'httpStatus' => 200,
                            'model' => 'gpt-5.6-sol',
                            'sourceAction' => 'ai_gateway',
                            'promptAction' => 'pre_translate',
                            'systemCredentials' => true,
                            'isAutoTriggered' => false,
                            'durationMs' => 842,
                            'inputTokens' => 512,
                            'outputTokens' => 128,
                            'totalCost' => 0.012345,
                            'userId' => 42,
                            'projectId' => 8,
                            'promptId' => 5,
                            'aiProviderId' => 3,
                            'tokenName' => 'CI token',
                            'oauthClientId' => 'gpbccUFxAKZDrLm5Nq8t',
                            'oauthClientName' => 'AI Pipeline',
                            'ip' => '203.0.113.42',
                            'userAgent' => 'Mozilla/5.0',
                            'error' => null,
                        ],
                    ],
                ],
                'pagination' => [
                    'offset' => 20,
                    'limit' => 10,
                ],
            ]),
        ]);

        $requestLogs = $this->crowdin->ai->listRequestLogs(1, [
            'requestId' => '9d3b1c4e-2f3a-4b5c-8d6e-7f8a9b0c1d2e',
            'projectId' => 8,
            'userId' => 42,
            'aiProviderId' => 3,
            'model' => 'gpt-5.6-sol',
            'sourceAction' => 'ai_gateway',
            'promptAction' => 'pre_translate',
            'statuses' => 'pending,success',
            'systemCredentials' => true,
            'isAutoTriggered' => false,
            'tokenName' => 'CI token',
            'oauthClientId' => 'gpbccUFxAKZDrLm5Nq8t',
            'createdAfter' => '2026-01-01T00:00:00+00:00',
            'createdBefore' => '2026-01-02T00:00:00+00:00',
            'limit' => 10,
            'offset' => 20,
        ]);

        $this->assertInstanceOf(ModelCollection::class, $requestLogs);
        $this->assertCount(1, $requestLogs);
        $this->assertInstanceOf(AiRequestLog::class, $requestLogs[0]);
        $this->assertEquals(12345, $requestLogs[0]->getId());
        $this->assertEquals('success', $requestLogs[0]->getStatus());
        $this->assertEquals(0.012345, $requestLogs[0]->getTotalCost());
    }

    public function testGetSettings(): void
    {
        $this->mockRequest([
            'path' => '/users/1/ai/settings',
            'method' => 'get',
            'response' => json_encode([
                'data' => [
                    'preTranslationAiPromptId' => 2,
                    'editorSuggestionAiPromptId' => 5,
                    'qaCheckActionAiPromptId' => 8,
                    'contextReviewAiPromptId' => 11,
                ],
            ]),
        ]);

        $settings = $this->crowdin->ai->getSettings(1);

        $this->assertInstanceOf(AiSettings::class, $settings);
        $this->assertEquals(2, $settings->getPreTranslationAiPromptId());
        $this->assertEquals(5, $settings->getEditorSuggestionAiPromptId());
        $this->assertEquals(8, $settings->getQaCheckActionAiPromptId());
        $this->assertEquals(11, $settings->getContextReviewAiPromptId());
    }

    public function testListSnippets(): void
    {
        $this->mockRequest([
            'path' => '/users/1/ai/settings/snippets',
            'method' => 'get',
            'response' => json_encode([
                'data' => [
                    [
                        'data' => [
                            'id' => 2,
                            'description' => 'Product description',
                            'placeholder' => '%custom:productDescription%',
                            'value' => 'The product is the professional consulting service that transform challenges into opportunities.',
                            'createdAt' => '2019-09-20T11:11:05+00:00',
                            'updatedAt' => '2019-09-20T12:22:20+00:00',
                        ],
                    ],
                ],
                'pagination' => [
                    'offset' => 0,
                    'limit' => 25,
                ],
            ]),
        ]);

        $snippets = $this->crowdin->ai->listSnippets(1);

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
            'path' => '/users/1/ai/settings/snippets',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => $this->snippetResponse(),
        ]);

        $snippet = $this->crowdin->ai->createSnippet(1, $params);

        $this->assertInstanceOf(AiSnippet::class, $snippet);
        $this->assertEquals(2, $snippet->getId());
        $this->assertEquals('Product description', $snippet->getDescription());
    }

    public function testGetSnippet(): void
    {
        $this->mockRequest([
            'path' => '/users/1/ai/settings/snippets/2',
            'method' => 'get',
            'response' => $this->snippetResponse(),
        ]);

        $snippet = $this->crowdin->ai->getSnippet(1, 2);

        $this->assertInstanceOf(AiSnippet::class, $snippet);
        $this->assertEquals(
            'The product is the professional consulting service that transform challenges into opportunities.',
            $snippet->getValue()
        );
        $this->assertEquals('2019-09-20T11:11:05+00:00', $snippet->getCreatedAt());
        $this->assertEquals('2019-09-20T12:22:20+00:00', $snippet->getUpdatedAt());
    }

    private function snippetResponse(): string
    {
        return json_encode([
            'data' => [
                'id' => 2,
                'description' => 'Product description',
                'placeholder' => '%custom:productDescription%',
                'value' => 'The product is the professional consulting service that transform challenges into opportunities.',
                'createdAt' => '2019-09-20T11:11:05+00:00',
                'updatedAt' => '2019-09-20T12:22:20+00:00',
            ],
        ]);
    }

    public function testDeleteSnippet(): void
    {
        $this->mockRequest([
            'path' => '/users/1/ai/settings/snippets/2',
            'method' => 'delete',
            'response' => '',
        ]);

        $this->crowdin->ai->deleteSnippet(1, 2);
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
            '/users/1/ai/prompts/2',
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

        $updated = $this->crowdin->ai->updatePrompt(1, $prompt);

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
            '/users/1/ai/providers/2',
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

        $updated = $this->crowdin->ai->updateProvider(1, $provider);

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
            '/users/1/ai/settings',
            json_encode([
                'data' => [
                    'preTranslationAiPromptId' => 3,
                    'editorSuggestionAiPromptId' => 6,
                    'qaCheckActionAiPromptId' => 9,
                    'contextReviewAiPromptId' => 12,
                ],
            ])
        );

        $updated = $this->crowdin->ai->updateSettings(1, $settings);

        $this->assertInstanceOf(AiSettings::class, $updated);
        $this->assertEquals(3, $updated->getPreTranslationAiPromptId());
        $this->assertEquals(6, $updated->getEditorSuggestionAiPromptId());
        $this->assertEquals(9, $updated->getQaCheckActionAiPromptId());
        $this->assertEquals(12, $updated->getContextReviewAiPromptId());
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
            '/users/1/ai/settings/snippets/2',
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

        $updated = $this->crowdin->ai->updateSnippet(1, $snippet);

        $this->assertInstanceOf(AiSnippet::class, $updated);
        $this->assertEquals('Updated description', $updated->getDescription());
        $this->assertEquals('%custom:updatedDescription%', $updated->getPlaceholder());
        $this->assertEquals('Updated value.', $updated->getValue());
    }

    public function testGetProjectSettings(): void
    {
        $this->mockRequest([
            'path' => '/projects/2/ai/settings',
            'method' => 'get',
            'response' => json_encode([
                'data' => [
                    'editorSuggestionAiPromptId' => 6,
                    'alignmentActionAiPromptId' => null,
                    'qaCheckActionAiPromptId' => 9,
                    'contextReviewAiPromptId' => 12,
                ],
            ]),
        ]);

        $result = $this->crowdin->ai->getProjectSettings(2);

        $this->assertInstanceOf(ProjectAiSettings::class, $result);
        $this->assertEquals(6, $result->getEditorSuggestionAiPromptId());
        $this->assertNull($result->getAlignmentActionAiPromptId());
    }

    public function testGenerateFineTuningDataset(): void
    {
        $data = [
            'projectIds' => [1],
            'tmIds' => [2],
            'purpose' => 'training',
        ];

        $this->mockRequest([
            'path' => '/users/1/ai/prompts/3/fine-tuning/datasets',
            'method' => 'post',
            'body' => json_encode($data),
            'response' => $this->fineTuningDatasetResponse(),
        ]);

        $result = $this->crowdin->ai->generateFineTuningDataset(1, 3, $data);

        $this->assertInstanceOf(AiFineTuningDataset::class, $result);
        $this->assertEquals('1d5b5a0b-6b1c-4f1a-9f3b-2b1e1c3d4e5f', $result->getIdentifier());
        $this->assertEquals('training', $result->getAttributes()['purpose']);
    }

    public function testGetFineTuningDataset(): void
    {
        $this->mockRequest([
            'path' => '/users/1/ai/prompts/3/fine-tuning/datasets/1d5b5a0b-6b1c-4f1a-9f3b-2b1e1c3d4e5f',
            'method' => 'get',
            'response' => $this->fineTuningDatasetResponse(),
        ]);

        $result = $this->crowdin->ai->getFineTuningDataset(1, 3, '1d5b5a0b-6b1c-4f1a-9f3b-2b1e1c3d4e5f');

        $this->assertInstanceOf(AiFineTuningDataset::class, $result);
        $this->assertEquals('finished', $result->getStatus());
    }

    private function fineTuningDatasetResponse(): string
    {
        return json_encode([
            'data' => [
                'identifier' => '1d5b5a0b-6b1c-4f1a-9f3b-2b1e1c3d4e5f',
                'status' => 'finished',
                'progress' => 100,
                'attributes' => [
                    'projectIds' => [1],
                    'tmIds' => [2],
                    'purpose' => 'training',
                ],
                'createdAt' => '2025-09-23T11:26:54+00:00',
                'updatedAt' => '2025-09-23T11:26:54+00:00',
                'startedAt' => '2025-09-23T11:26:54+00:00',
                'finishedAt' => '2025-09-23T11:26:54+00:00',
            ],
        ]);
    }

    public function testDownloadFineTuningDataset(): void
    {
        $this->mockRequest([
            'path' => '/users/1/ai/prompts/3/fine-tuning/datasets/1d5b5a0b-6b1c-4f1a-9f3b-2b1e1c3d4e5f/download',
            'method' => 'get',
            'response' => $this->jsonlDownloadResponse(),
        ]);

        $result = $this->crowdin->ai->downloadFineTuningDataset(1, 3, '1d5b5a0b-6b1c-4f1a-9f3b-2b1e1c3d4e5f');

        $this->assertInstanceOf(DownloadFile::class, $result);
        $this->assertEquals('https://production-enterprise-importer.downloads.crowdin.com/file.jsonl', $result->getUrl());
    }

    private function jsonlDownloadResponse(): string
    {
        return json_encode([
            'data' => [
                'url' => 'https://production-enterprise-importer.downloads.crowdin.com/file.jsonl',
                'expireIn' => '2025-09-20T10:31:21+00:00',
            ],
        ]);
    }

    public function testListFineTuningJobs(): void
    {
        $this->mockRequest([
            'path' => '/users/1/ai/prompts/fine-tuning/jobs?statuses=in_progress',
            'method' => 'get',
            'response' => json_encode([
                'data' => [
                    [
                        'data' => [
                            'identifier' => 'a1b2c3d4-0000-4000-8000-000000000001',
                            'status' => 'in_progress',
                            'progress' => 50,
                            'attributes' => [
                                'dryRun' => false,
                                'aiPromptId' => 3,
                                'trainingOptions' => [
                                    'projectIds' => [1],
                                ],
                                'fineTunedModel' => null,
                            ],
                            'createdAt' => '2025-09-23T11:26:54+00:00',
                            'updatedAt' => '2025-09-23T11:26:54+00:00',
                            'startedAt' => '2025-09-23T11:26:54+00:00',
                            'finishedAt' => null,
                        ],
                    ],
                ],
                'pagination' => [
                    'offset' => 0,
                    'limit' => 25,
                ],
            ]),
        ]);

        $result = $this->crowdin->ai->listFineTuningJobs(1, ['statuses' => 'in_progress']);

        $this->assertInstanceOf(ModelCollection::class, $result);
        $this->assertCount(1, $result);
        $this->assertInstanceOf(AiFineTuningJob::class, $result[0]);
        $this->assertEquals('in_progress', $result[0]->getStatus());
    }

    public function testCreateFineTuningJob(): void
    {
        $data = [
            'dryRun' => false,
            'hyperparameters' => [
                'nEpochs' => 3,
            ],
            'trainingOptions' => [
                'projectIds' => [1],
            ],
        ];

        $this->mockRequest([
            'path' => '/users/1/ai/prompts/3/fine-tuning/jobs',
            'method' => 'post',
            'body' => json_encode($data),
            'response' => $this->fineTuningJobResponse(),
        ]);

        $result = $this->crowdin->ai->createFineTuningJob(1, 3, $data);

        $this->assertInstanceOf(AiFineTuningJob::class, $result);
        $this->assertEquals(3, $result->getAttributes()['aiPromptId']);
    }

    public function testGetFineTuningJob(): void
    {
        $this->mockRequest([
            'path' => '/users/1/ai/prompts/3/fine-tuning/jobs/a1b2c3d4-0000-4000-8000-000000000001',
            'method' => 'get',
            'response' => $this->fineTuningJobResponse(),
        ]);

        $result = $this->crowdin->ai->getFineTuningJob(1, 3, 'a1b2c3d4-0000-4000-8000-000000000001');

        $this->assertInstanceOf(AiFineTuningJob::class, $result);
        $this->assertEquals(50, $result->getProgress());
        $this->assertNull($result->getFinishedAt());
    }

    private function fineTuningJobResponse(): string
    {
        return json_encode([
            'data' => [
                'identifier' => 'a1b2c3d4-0000-4000-8000-000000000001',
                'status' => 'in_progress',
                'progress' => 50,
                'attributes' => [
                    'dryRun' => false,
                    'aiPromptId' => 3,
                    'trainingOptions' => [
                        'projectIds' => [1],
                    ],
                    'fineTunedModel' => null,
                ],
                'createdAt' => '2025-09-23T11:26:54+00:00',
                'updatedAt' => '2025-09-23T11:26:54+00:00',
                'startedAt' => '2025-09-23T11:26:54+00:00',
                'finishedAt' => null,
            ],
        ]);
    }

    public function testListFineTuningEvents(): void
    {
        $this->mockRequest([
            'path' => '/users/1/ai/prompts/3/fine-tuning/jobs/a1b2c3d4-0000-4000-8000-000000000001/events',
            'method' => 'get',
            'response' => json_encode([
                'data' => [
                    [
                        'data' => [
                            'id' => 'ftevent-1',
                            'type' => 'metrics',
                            'message' => 'Step 1/10',
                            'data' => [
                                'step' => 1,
                                'totalSteps' => 10,
                                'trainingLoss' => 0.5,
                            ],
                            'createdAt' => '2025-09-23T11:26:54+00:00',
                        ],
                    ],
                ],
                'pagination' => [
                    'offset' => 0,
                    'limit' => 25,
                ],
            ]),
        ]);

        $result = $this->crowdin->ai->listFineTuningEvents(1, 3, 'a1b2c3d4-0000-4000-8000-000000000001');

        $this->assertInstanceOf(ModelCollection::class, $result);
        $this->assertCount(1, $result);
        $this->assertInstanceOf(AiFineTuningEvent::class, $result[0]);
        $this->assertEquals('metrics', $result[0]->getType());
        $this->assertEquals(10, $result[0]->getEventData()['totalSteps']);
    }

    public function testListAllProviderModels(): void
    {
        $this->mockRequest([
            'path' => '/users/1/ai/providers/models',
            'method' => 'get',
            'response' => json_encode([
                'data' => [
                    [
                        'data' => [
                            'id' => 'gpt-4.1',
                            'provider' => 'open_ai',
                            'providerName' => 'OpenAI',
                            'providerId' => 2,
                            'contextWindow' => 128000,
                            'maxOutputTokens' => 16384,
                            'supportsStreaming' => true,
                            'supportsFunctionCalling' => true,
                            'supportsJsonMode' => true,
                            'supportsJsonSchema' => true,
                            'supportsVision' => false,
                            'isCompatibleWithAiLimit' => true,
                        ],
                    ],
                ],
                'pagination' => [
                    'offset' => 0,
                    'limit' => 25,
                ],
            ]),
        ]);

        $result = $this->crowdin->ai->listAllProviderModels(1);

        $this->assertInstanceOf(ModelCollection::class, $result);
        $this->assertCount(1, $result);
        $this->assertInstanceOf(AiProviderModel::class, $result[0]);
        $this->assertEquals(128000, $result[0]->getContextWindow());
        $this->assertTrue($result[0]->getIsCompatibleWithAiLimit());
    }

    public function testListSupportedProviderModels(): void
    {
        $this->mockRequest([
            'path' => '/users/1/ai/providers/supported-models?providerType=open_ai',
            'method' => 'get',
            'response' => json_encode([
                'data' => [
                    [
                        'data' => [
                            'providerId' => 2,
                            'providerType' => 'open_ai',
                            'providerName' => 'OpenAI',
                            'id' => 'gpt-4.1',
                            'displayName' => 'GPT-4.1',
                            'supportReasoning' => false,
                            'intelligence' => 4,
                            'speed' => 3,
                            'price' => [
                                'input' => 2.0,
                                'output' => 8.0,
                            ],
                            'modalities' => [
                                'input' => ['text'],
                                'output' => ['text'],
                            ],
                            'contextWindow' => 128000,
                            'maxOutputTokens' => 16384,
                            'knowledgeCutoff' => '2024-06',
                            'releaseDate' => '2025-04-14',
                            'features' => [
                                'streaming' => true,
                                'structuredOutput' => true,
                                'functionCalling' => true,
                            ],
                        ],
                    ],
                ],
                'pagination' => [
                    'offset' => 0,
                    'limit' => 25,
                ],
            ]),
        ]);

        $result = $this->crowdin->ai->listSupportedProviderModels(1, ['providerType' => 'open_ai']);

        $this->assertInstanceOf(ModelCollection::class, $result);
        $this->assertCount(1, $result);
        $this->assertInstanceOf(AiSupportedModel::class, $result[0]);
        $this->assertEquals('GPT-4.1', $result[0]->getDisplayName());
    }

    public function testExportRequestLogs(): void
    {
        $data = [
            'format' => 'csv',
            'projectId' => 1,
        ];

        $this->mockRequest([
            'path' => '/users/1/ai/request-logs/exports',
            'method' => 'post',
            'body' => json_encode($data),
            'response' => $this->requestLogExportResponse(),
        ]);

        $result = $this->crowdin->ai->exportRequestLogs(1, $data);

        $this->assertInstanceOf(AiRequestLogExport::class, $result);
        $this->assertEquals('created', $result->getStatus());
        $this->assertEquals('10 seconds', $result->getEta());
    }

    public function testGetRequestLogsExport(): void
    {
        $this->mockRequest([
            'path' => '/users/1/ai/request-logs/exports/e7c1d7f2-1111-4222-8333-444455556666',
            'method' => 'get',
            'response' => $this->requestLogExportResponse(),
        ]);

        $result = $this->crowdin->ai->getRequestLogsExport(1, 'e7c1d7f2-1111-4222-8333-444455556666');

        $this->assertInstanceOf(AiRequestLogExport::class, $result);
        $this->assertEquals('e7c1d7f2-1111-4222-8333-444455556666', $result->getIdentifier());
    }

    private function requestLogExportResponse(): string
    {
        return json_encode([
            'data' => [
                'identifier' => 'e7c1d7f2-1111-4222-8333-444455556666',
                'status' => 'created',
                'progress' => 0,
                'attributes' => [
                    'format' => 'csv',
                    'filters' => [
                        'projectId' => 1,
                    ],
                ],
                'createdAt' => '2025-09-23T11:26:54+00:00',
                'updatedAt' => '2025-09-23T11:26:54+00:00',
                'startedAt' => null,
                'finishedAt' => null,
                'eta' => '10 seconds',
            ],
        ]);
    }

    public function testDownloadRequestLogsExport(): void
    {
        $this->mockRequest([
            'path' => '/users/1/ai/request-logs/exports/e7c1d7f2-1111-4222-8333-444455556666/download',
            'method' => 'get',
            'response' => $this->jsonlDownloadResponse(),
        ]);

        $result = $this->crowdin->ai->downloadRequestLogsExport(1, 'e7c1d7f2-1111-4222-8333-444455556666');

        $this->assertInstanceOf(DownloadFile::class, $result);
        $this->assertEquals('2025-09-20T10:31:21+00:00', $result->getExpireIn());
    }

    public function testListUsageMembers(): void
    {
        $this->mockRequest([
            'path' => '/users/1/ai/usage/members?limit=10',
            'method' => 'get',
            'response' => json_encode([
                'data' => [
                    [
                        'data' => [
                            'user' => [
                                'id' => 12,
                                'username' => 'john',
                                'fullName' => 'John Smith',
                                'avatarUrl' => '',
                            ],
                            'dailyCostLimit' => 5,
                            'dailyCostSpent' => 1.25,
                            'dailyResetAt' => '2025-09-24T00:00:00+00:00',
                            'monthlyCostLimit' => null,
                            'monthlyCostSpent' => 10.5,
                            'monthlyResetAt' => '2025-10-01T00:00:00+00:00',
                        ],
                    ],
                ],
                'pagination' => [
                    'offset' => 0,
                    'limit' => 25,
                ],
            ]),
        ]);

        $result = $this->crowdin->ai->listUsageMembers(1, ['limit' => 10]);

        $this->assertInstanceOf(ModelCollection::class, $result);
        $this->assertCount(1, $result);
        $this->assertInstanceOf(AiMemberUsage::class, $result[0]);
        $this->assertEquals(12, $result[0]->getUser()['id']);
    }

    public function testGetUsageMember(): void
    {
        $this->mockRequest([
            'path' => '/users/1/ai/usage/members/12',
            'method' => 'get',
            'response' => json_encode([
                'data' => [
                    'user' => [
                        'id' => 12,
                        'username' => 'john',
                        'fullName' => 'John Smith',
                        'avatarUrl' => '',
                    ],
                    'dailyCostLimit' => 5,
                    'dailyCostSpent' => 1.25,
                    'dailyResetAt' => '2025-09-24T00:00:00+00:00',
                    'monthlyCostLimit' => null,
                    'monthlyCostSpent' => 10.5,
                    'monthlyResetAt' => '2025-10-01T00:00:00+00:00',
                ],
            ]),
        ]);

        $result = $this->crowdin->ai->getUsageMember(1, 12);

        $this->assertInstanceOf(AiMemberUsage::class, $result);
        $this->assertEquals(5.0, $result->getDailyCostLimit());
        $this->assertNull($result->getMonthlyCostLimit());
    }
}
