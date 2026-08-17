<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\AiFileTranslation;
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

/**
 * Use API to manage AI providers, prompts, and leverage AI-powered translation.
 *
 * @package Crowdin\Api
 */
class AiApi extends AbstractApi
{
    /**
     * AI Translate Strings
     * @link https://developer.crowdin.com/api/v2/#operation/api.users.ai.translate.strings.post API Documentation
     *
     * @param int $userId
     * @param array $data
     * array $data[strings] required<br>
     * string $data[targetLanguageId] required<br>
     * string $data[sourceLanguageId]<br>
     * array $data[tmIds]<br>
     * array $data[glossaryIds]<br>
     * integer $data[aiPromptId]<br>
     * integer $data[aiProviderId]<br>
     * string $data[aiModelId]<br>
     * array $data[instructions]<br>
     * array $data[attachmentIds]
     * @return AiTranslation|null
     */
    public function translateStrings(int $userId, array $data): ?AiTranslation
    {
        $path = sprintf('users/%d/ai/translate', $userId);
        return $this->_post($path, AiTranslation::class, $data);
    }

    /**
     * AI File Translations
     * @link https://developer.crowdin.com/api/v2/#operation/api.users.ai.file-translations.post API Documentation
     *
     * @param int $userId
     * @param array $data
     * integer $data[storageId] required<br>
     * string $data[targetLanguageId] required<br>
     * string $data[sourceLanguageId]<br>
     * string $data[type]<br>
     * integer $data[parserVersion]<br>
     * array $data[tmIds]<br>
     * array $data[glossaryIds]<br>
     * integer $data[aiPromptId]<br>
     * integer $data[aiProviderId]<br>
     * string $data[aiModelId]<br>
     * array $data[instructions]<br>
     * array $data[attachmentIds]
     * @return AiFileTranslation|null
     */
    public function createFileTranslation(int $userId, array $data): ?AiFileTranslation
    {
        $path = sprintf('users/%d/ai/file-translations', $userId);
        return $this->_post($path, AiFileTranslation::class, $data);
    }

    /**
     * Get File Translations Status
     * @link https://developer.crowdin.com/api/v2/#operation/api.users.ai.file-translations.get API Documentation
     *
     * @param int $userId
     * @param string $jobIdentifier
     * @return AiFileTranslation|null
     */
    public function getFileTranslation(int $userId, string $jobIdentifier): ?AiFileTranslation
    {
        $path = sprintf('users/%d/ai/file-translations/%s', $userId, $jobIdentifier);
        return $this->_get($path, AiFileTranslation::class);
    }

    /**
     * Cancel File Translations
     * @link https://developer.crowdin.com/api/v2/#operation/api.users.ai.file-translations.delete API Documentation
     *
     * @param int $userId
     * @param string $jobIdentifier
     * @return mixed
     */
    public function deleteFileTranslation(int $userId, string $jobIdentifier)
    {
        $path = sprintf('users/%d/ai/file-translations/%s', $userId, $jobIdentifier);
        return $this->_delete($path);
    }

    /**
     * Download Translated File
     * @link https://developer.crowdin.com/api/v2/#operation/api.users.ai.file-translations.download API Documentation
     *
     * @param int $userId
     * @param string $jobIdentifier
     * @return DownloadFile|null
     */
    public function downloadFileTranslation(int $userId, string $jobIdentifier): ?DownloadFile
    {
        $path = sprintf('users/%d/ai/file-translations/%s/download', $userId, $jobIdentifier);
        return $this->_get($path, DownloadFile::class);
    }

    /**
     * Download Translated File Strings
     * @link https://developer.crowdin.com/api/v2/#operation/api.users.ai.file-translations.download-strings API Documentation
     *
     * @param int $userId
     * @param string $jobIdentifier
     * @return DownloadFile|null
     */
    public function downloadFileTranslationStrings(int $userId, string $jobIdentifier): ?DownloadFile
    {
        $path = sprintf('users/%d/ai/file-translations/%s/translations', $userId, $jobIdentifier);
        return $this->_get($path, DownloadFile::class);
    }

    /**
     * List AI Prompts
     * @link https://developer.crowdin.com/api/v2/#operation/api.users.ai.prompts.getMany API Documentation
     *
     * @param int $userId
     * @param array $params
     * integer $params[projectId]<br>
     * string $params[action]<br>
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function listPrompts(int $userId, array $params = []): ModelCollection
    {
        $path = sprintf('users/%d/ai/prompts', $userId);
        return $this->_list($path, AiPrompt::class, $params);
    }

    /**
     * Add AI Prompt
     * @link https://developer.crowdin.com/api/v2/#operation/api.users.ai.prompts.post API Documentation
     *
     * @param int $userId
     * @param array $data
     * string $data[name] required<br>
     * string $data[action] required<br>
     * array $data[config] required<br>
     * integer $data[aiProviderId]<br>
     * string $data[aiModelId]<br>
     * boolean $data[isEnabled]<br>
     * array $data[enabledProjectIds]
     * @return AiPrompt|null
     */
    public function createPrompt(int $userId, array $data): ?AiPrompt
    {
        $path = sprintf('users/%d/ai/prompts', $userId);
        return $this->_create($path, AiPrompt::class, $data);
    }

    /**
     * Get AI Prompt
     * @link https://developer.crowdin.com/api/v2/#operation/api.users.ai.prompts.get API Documentation
     *
     * @param int $userId
     * @param int $aiPromptId
     * @return AiPrompt|null
     */
    public function getPrompt(int $userId, int $aiPromptId): ?AiPrompt
    {
        $path = sprintf('users/%d/ai/prompts/%d', $userId, $aiPromptId);
        return $this->_get($path, AiPrompt::class);
    }

    /**
     * Edit AI Prompt
     * @link https://developer.crowdin.com/api/v2/#operation/api.users.ai.prompts.patch API Documentation
     *
     * @param int $userId
     * @param AiPrompt $aiPrompt
     * @return AiPrompt|null
     */
    public function updatePrompt(int $userId, AiPrompt $aiPrompt): ?AiPrompt
    {
        $path = sprintf('users/%d/ai/prompts/%d', $userId, $aiPrompt->getId());
        return $this->_update($path, $aiPrompt);
    }

    /**
     * Delete AI Prompt
     * @link https://developer.crowdin.com/api/v2/#operation/api.users.ai.prompts.delete API Documentation
     *
     * @param int $userId
     * @param int $aiPromptId
     * @return mixed
     */
    public function deletePrompt(int $userId, int $aiPromptId)
    {
        $path = sprintf('users/%d/ai/prompts/%d', $userId, $aiPromptId);
        return $this->_delete($path);
    }

    /**
     * Clone AI Prompt
     * @link https://developer.crowdin.com/api/v2/#operation/api.users.ai.prompts.clones.post API Documentation
     *
     * @param int $userId
     * @param int $aiPromptId
     * @param array $data
     * string $data[name] required
     * @return AiPrompt|null
     */
    public function clonePrompt(int $userId, int $aiPromptId, array $data): ?AiPrompt
    {
        $path = sprintf('users/%d/ai/prompts/%d/clones', $userId, $aiPromptId);
        return $this->_post($path, AiPrompt::class, $data);
    }

    /**
     * Create AI Prompt Completion
     * @link https://developer.crowdin.com/api/v2/#operation/api.users.ai.prompts.completions.post API Documentation
     *
     * @param int $userId
     * @param int $aiPromptId
     * @param array $data
     * array $data[resources] required<br>
     * array $data[tools]<br>
     * mixed $data[tool_choice]
     * @return AiPromptCompletion|null
     */
    public function createPromptCompletion(int $userId, int $aiPromptId, array $data): ?AiPromptCompletion
    {
        $path = sprintf('users/%d/ai/prompts/%d/completions', $userId, $aiPromptId);
        return $this->_post($path, AiPromptCompletion::class, $data);
    }

    /**
     * Get AI Prompt Completion Status
     * @link https://developer.crowdin.com/api/v2/#operation/api.users.ai.prompts.completions.get API Documentation
     *
     * @param int $userId
     * @param int $aiPromptId
     * @param string $completionId
     * @return AiPromptCompletion|null
     */
    public function getPromptCompletion(int $userId, int $aiPromptId, string $completionId): ?AiPromptCompletion
    {
        $path = sprintf('users/%d/ai/prompts/%d/completions/%s', $userId, $aiPromptId, $completionId);
        return $this->_get($path, AiPromptCompletion::class);
    }

    /**
     * Cancel AI Prompt Completion
     * @link https://developer.crowdin.com/api/v2/#operation/api.users.ai.prompts.completions.delete API Documentation
     *
     * @param int $userId
     * @param int $aiPromptId
     * @param string $completionId
     * @return mixed
     */
    public function deletePromptCompletion(int $userId, int $aiPromptId, string $completionId)
    {
        $path = sprintf('users/%d/ai/prompts/%d/completions/%s', $userId, $aiPromptId, $completionId);
        return $this->_delete($path);
    }

    /**
     * Download AI Prompt Completion
     * @link https://developer.crowdin.com/api/v2/#operation/api.users.ai.prompts.completions.download.download API Documentation
     *
     * @param int $userId
     * @param int $aiPromptId
     * @param string $completionId
     * @return DownloadFile|null
     */
    public function downloadPromptCompletion(int $userId, int $aiPromptId, string $completionId): ?DownloadFile
    {
        $path = sprintf('users/%d/ai/prompts/%d/completions/%s/download', $userId, $aiPromptId, $completionId);
        return $this->_get($path, DownloadFile::class);
    }

    /**
     * List AI Providers
     * @link https://developer.crowdin.com/api/v2/#operation/api.users.ai.providers.getMany API Documentation
     *
     * @param int $userId
     * @param array $params
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function listProviders(int $userId, array $params = []): ModelCollection
    {
        $path = sprintf('users/%d/ai/providers', $userId);
        return $this->_list($path, AiProvider::class, $params);
    }

    /**
     * Add AI Provider
     * @link https://developer.crowdin.com/api/v2/#operation/api.users.ai.providers.post API Documentation
     *
     * @param int $userId
     * @param array $data
     * string $data[name] required<br>
     * string $data[type] required<br>
     * array $data[credentials]<br>
     * array $data[config]<br>
     * boolean $data[isEnabled]<br>
     * boolean $data[useSystemCredentials]
     * @return AiProvider|null
     */
    public function createProvider(int $userId, array $data): ?AiProvider
    {
        $path = sprintf('users/%d/ai/providers', $userId);
        return $this->_create($path, AiProvider::class, $data);
    }

    /**
     * Get AI Provider
     * @link https://developer.crowdin.com/api/v2/#operation/api.users.ai.providers.get API Documentation
     *
     * @param int $userId
     * @param int $aiProviderId
     * @return AiProvider|null
     */
    public function getProvider(int $userId, int $aiProviderId): ?AiProvider
    {
        $path = sprintf('users/%d/ai/providers/%d', $userId, $aiProviderId);
        return $this->_get($path, AiProvider::class);
    }

    /**
     * Edit AI Provider
     * @link https://developer.crowdin.com/api/v2/#operation/api.users.ai.providers.patch API Documentation
     *
     * @param int $userId
     * @param AiProvider $aiProvider
     * @return AiProvider|null
     */
    public function updateProvider(int $userId, AiProvider $aiProvider): ?AiProvider
    {
        $path = sprintf('users/%d/ai/providers/%d', $userId, $aiProvider->getId());
        return $this->_update($path, $aiProvider);
    }

    /**
     * Delete AI Provider
     * @link https://developer.crowdin.com/api/v2/#operation/api.users.ai.providers.delete API Documentation
     *
     * @param int $userId
     * @param int $aiProviderId
     * @return mixed
     */
    public function deleteProvider(int $userId, int $aiProviderId)
    {
        $path = sprintf('users/%d/ai/providers/%d', $userId, $aiProviderId);
        return $this->_delete($path);
    }

    /**
     * List AI Provider Models
     * @link https://developer.crowdin.com/api/v2/#operation/api.users.ai.providers.models.getMany API Documentation
     *
     * @param int $userId
     * @param int $aiProviderId
     * @param array $params
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function listProviderModels(int $userId, int $aiProviderId, array $params = []): ModelCollection
    {
        $path = sprintf('users/%d/ai/providers/%d/models', $userId, $aiProviderId);
        return $this->_list($path, AiProviderModel::class, $params);
    }

    /**
     * Create AI Provider Chat Completion
     * @link https://developer.crowdin.com/api/v2/#operation/api.users.ai.providers.chat.completions.post API Documentation
     *
     * @param int $userId
     * @param int $aiProviderId
     * @param array $data
     * string $data[model]<br>
     * boolean $data[stream]
     * @return AiProxyChatCompletion|null
     */
    public function createProviderChatCompletion(
        int $userId,
        int $aiProviderId,
        array $data
    ): ?AiProxyChatCompletion {
        $path = sprintf('users/%d/ai/providers/%d/chat/completions', $userId, $aiProviderId);
        return $this->_post($path, AiProxyChatCompletion::class, $data);
    }

    /**
     * Generate AI Report
     * @link https://developer.crowdin.com/api/v2/#operation/api.users.ai.reports.post API Documentation
     *
     * @param int $userId
     * @param array $data
     * string $data[type] required<br>
     * array $data[schema] required
     * @return AiReport|null
     */
    public function generateReport(int $userId, array $data): ?AiReport
    {
        $path = sprintf('users/%d/ai/reports', $userId);
        return $this->_post($path, AiReport::class, $data);
    }

    /**
     * Check AI Report Generation Status
     * @link https://developer.crowdin.com/api/v2/#operation/api.users.ai.reports.get API Documentation
     *
     * @param int $userId
     * @param string $aiReportId
     * @return AiReport|null
     */
    public function getReport(int $userId, string $aiReportId): ?AiReport
    {
        $path = sprintf('users/%d/ai/reports/%s', $userId, $aiReportId);
        return $this->_get($path, AiReport::class);
    }

    /**
     * Download AI Report
     * @link https://developer.crowdin.com/api/v2/#operation/api.users.ai.reports.download.download API Documentation
     *
     * @param int $userId
     * @param string $aiReportId
     * @return DownloadFile|null
     */
    public function downloadReport(int $userId, string $aiReportId): ?DownloadFile
    {
        $path = sprintf('users/%d/ai/reports/%s/download', $userId, $aiReportId);
        return $this->_get($path, DownloadFile::class);
    }

    /**
     * Get AI Settings
     * @link https://developer.crowdin.com/api/v2/#operation/api.users.ai.settings.get API Documentation
     *
     * @param int $userId
     * @return AiSettings|null
     */
    public function getSettings(int $userId): ?AiSettings
    {
        $path = sprintf('users/%d/ai/settings', $userId);
        return $this->_get($path, AiSettings::class);
    }

    /**
     * Edit AI Settings
     * @link https://developer.crowdin.com/api/v2/#operation/api.users.ai.settings.patch API Documentation
     *
     * @param int $userId
     * @param AiSettings $aiSettings
     * @return AiSettings|null
     */
    public function updateSettings(int $userId, AiSettings $aiSettings): ?AiSettings
    {
        $path = sprintf('users/%d/ai/settings', $userId);
        return $this->_update($path, $aiSettings);
    }

    /**
     * List AI Snippets
     * @link https://developer.crowdin.com/api/v2/#operation/api.users.ai.settings.snippets.getMany API Documentation
     *
     * @param int $userId
     * @param array $params
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function listSnippets(int $userId, array $params = []): ModelCollection
    {
        $path = sprintf('users/%d/ai/settings/snippets', $userId);
        return $this->_list($path, AiSnippet::class, $params);
    }

    /**
     * Add AI Snippet
     * @link https://developer.crowdin.com/api/v2/#operation/api.users.ai.settings.snippets.post API Documentation
     *
     * @param int $userId
     * @param array $data
     * string $data[description] required<br>
     * string $data[placeholder] required<br>
     * string $data[value] required
     * @return AiSnippet|null
     */
    public function createSnippet(int $userId, array $data): ?AiSnippet
    {
        $path = sprintf('users/%d/ai/settings/snippets', $userId);
        return $this->_create($path, AiSnippet::class, $data);
    }

    /**
     * Get AI Snippet
     * @link https://developer.crowdin.com/api/v2/#operation/api.users.ai.settings.snippets.get API Documentation
     *
     * @param int $userId
     * @param int $aiSnippetId
     * @return AiSnippet|null
     */
    public function getSnippet(int $userId, int $aiSnippetId): ?AiSnippet
    {
        $path = sprintf('users/%d/ai/settings/snippets/%d', $userId, $aiSnippetId);
        return $this->_get($path, AiSnippet::class);
    }

    /**
     * Edit AI Snippet
     * @link https://developer.crowdin.com/api/v2/#operation/api.users.ai.settings.snippets.patch API Documentation
     *
     * @param int $userId
     * @param AiSnippet $aiSnippet
     * @return AiSnippet|null
     */
    public function updateSnippet(int $userId, AiSnippet $aiSnippet): ?AiSnippet
    {
        $path = sprintf('users/%d/ai/settings/snippets/%d', $userId, $aiSnippet->getId());
        return $this->_update($path, $aiSnippet);
    }

    /**
     * Delete AI Snippet
     * @link https://developer.crowdin.com/api/v2/#operation/api.users.ai.settings.snippets.delete API Documentation
     *
     * @param int $userId
     * @param int $aiSnippetId
     * @return mixed
     */
    public function deleteSnippet(int $userId, int $aiSnippetId)
    {
        $path = sprintf('users/%d/ai/settings/snippets/%d', $userId, $aiSnippetId);
        return $this->_delete($path);
    }
}
