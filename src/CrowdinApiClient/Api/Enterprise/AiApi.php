<?php

namespace CrowdinApiClient\Api\Enterprise;

use CrowdinApiClient\Api\AbstractApi;
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
 * @package Crowdin\Api\Enterprise
 */
class AiApi extends AbstractApi
{
    /**
     * AI Translate Strings
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.translate.strings.post API Documentation
     *
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
    public function translateStrings(array $data): ?AiTranslation
    {
        return $this->_post('ai/translate', AiTranslation::class, $data);
    }

    /**
     * AI File Translations
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.file-translations.post API Documentation
     *
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
    public function createFileTranslation(array $data): ?AiFileTranslation
    {
        return $this->_post('ai/file-translations', AiFileTranslation::class, $data);
    }

    /**
     * Get File Translations Status
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.file-translations.get API Documentation
     *
     * @param string $jobIdentifier
     * @return AiFileTranslation|null
     */
    public function getFileTranslation(string $jobIdentifier): ?AiFileTranslation
    {
        $path = sprintf('ai/file-translations/%s', $jobIdentifier);
        return $this->_get($path, AiFileTranslation::class);
    }

    /**
     * Cancel File Translations
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.file-translations.delete API Documentation
     *
     * @param string $jobIdentifier
     * @return mixed
     */
    public function deleteFileTranslation(string $jobIdentifier)
    {
        $path = sprintf('ai/file-translations/%s', $jobIdentifier);
        return $this->_delete($path);
    }

    /**
     * Download Translated File
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.file-translations.download API Documentation
     *
     * @param string $jobIdentifier
     * @return DownloadFile|null
     */
    public function downloadFileTranslation(string $jobIdentifier): ?DownloadFile
    {
        $path = sprintf('ai/file-translations/%s/download', $jobIdentifier);
        return $this->_get($path, DownloadFile::class);
    }

    /**
     * Download File Strings
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.file-translations.download-strings API Documentation
     *
     * @param string $jobIdentifier
     * @return DownloadFile|null
     */
    public function downloadFileTranslationStrings(string $jobIdentifier): ?DownloadFile
    {
        $path = sprintf('ai/file-translations/%s/translations', $jobIdentifier);
        return $this->_get($path, DownloadFile::class);
    }

    /**
     * List AI Prompts
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.prompts.getMany API Documentation
     *
     * @param array $params
     * integer $params[projectId]<br>
     * string $params[action]<br>
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function listPrompts(array $params = []): ModelCollection
    {
        return $this->_list('ai/prompts', AiPrompt::class, $params);
    }

    /**
     * Add AI Prompt
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.prompts.post API Documentation
     *
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
    public function createPrompt(array $data): ?AiPrompt
    {
        return $this->_create('ai/prompts', AiPrompt::class, $data);
    }

    /**
     * Get AI Prompt
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.prompts.get API Documentation
     *
     * @param int $aiPromptId
     * @return AiPrompt|null
     */
    public function getPrompt(int $aiPromptId): ?AiPrompt
    {
        $path = sprintf('ai/prompts/%d', $aiPromptId);
        return $this->_get($path, AiPrompt::class);
    }

    /**
     * Edit AI Prompt
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.prompts.patch API Documentation
     *
     * @param AiPrompt $aiPrompt
     * @return AiPrompt|null
     */
    public function updatePrompt(AiPrompt $aiPrompt): ?AiPrompt
    {
        $path = sprintf('ai/prompts/%d', $aiPrompt->getId());
        return $this->_update($path, $aiPrompt);
    }

    /**
     * Delete AI Prompt
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.prompts.delete API Documentation
     *
     * @param int $aiPromptId
     * @return mixed
     */
    public function deletePrompt(int $aiPromptId)
    {
        $path = sprintf('ai/prompts/%d', $aiPromptId);
        return $this->_delete($path);
    }

    /**
     * Clone AI Prompt
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.prompts.clones.post API Documentation
     *
     * @param int $aiPromptId
     * @param array $data
     * string $data[name] required
     * @return AiPrompt|null
     */
    public function clonePrompt(int $aiPromptId, array $data): ?AiPrompt
    {
        $path = sprintf('ai/prompts/%d/clones', $aiPromptId);
        return $this->_post($path, AiPrompt::class, $data);
    }

    /**
     * Create AI Prompt Completion
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.prompts.completions.post API Documentation
     *
     * @param int $aiPromptId
     * @param array $data
     * array $data[resources] required<br>
     * array $data[tools]<br>
     * mixed $data[tool_choice]
     * @return AiPromptCompletion|null
     */
    public function createPromptCompletion(int $aiPromptId, array $data): ?AiPromptCompletion
    {
        $path = sprintf('ai/prompts/%d/completions', $aiPromptId);
        return $this->_post($path, AiPromptCompletion::class, $data);
    }

    /**
     * Get AI Prompt Completion Status
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.prompts.completions.get API Documentation
     *
     * @param int $aiPromptId
     * @param string $completionId
     * @return AiPromptCompletion|null
     */
    public function getPromptCompletion(int $aiPromptId, string $completionId): ?AiPromptCompletion
    {
        $path = sprintf('ai/prompts/%d/completions/%s', $aiPromptId, $completionId);
        return $this->_get($path, AiPromptCompletion::class);
    }

    /**
     * Cancel AI Prompt Completion
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.prompts.completions.delete API Documentation
     *
     * @param int $aiPromptId
     * @param string $completionId
     * @return mixed
     */
    public function deletePromptCompletion(int $aiPromptId, string $completionId)
    {
        $path = sprintf('ai/prompts/%d/completions/%s', $aiPromptId, $completionId);
        return $this->_delete($path);
    }

    /**
     * Download AI Prompt Completion
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.prompts.completions.download.download API Documentation
     *
     * @param int $aiPromptId
     * @param string $completionId
     * @return DownloadFile|null
     */
    public function downloadPromptCompletion(int $aiPromptId, string $completionId): ?DownloadFile
    {
        $path = sprintf('ai/prompts/%d/completions/%s/download', $aiPromptId, $completionId);
        return $this->_get($path, DownloadFile::class);
    }

    /**
     * List AI Providers
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.providers.getMany API Documentation
     *
     * @param array $params
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function listProviders(array $params = []): ModelCollection
    {
        return $this->_list('ai/providers', AiProvider::class, $params);
    }

    /**
     * Add AI Provider
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.providers.post API Documentation
     *
     * @param array $data
     * string $data[name] required<br>
     * string $data[type] required<br>
     * array $data[credentials]<br>
     * array $data[config]<br>
     * boolean $data[isEnabled]<br>
     * boolean $data[useSystemCredentials]
     * @return AiProvider|null
     */
    public function createProvider(array $data): ?AiProvider
    {
        return $this->_create('ai/providers', AiProvider::class, $data);
    }

    /**
     * Get AI Provider
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.providers.get API Documentation
     *
     * @param int $aiProviderId
     * @return AiProvider|null
     */
    public function getProvider(int $aiProviderId): ?AiProvider
    {
        $path = sprintf('ai/providers/%d', $aiProviderId);
        return $this->_get($path, AiProvider::class);
    }

    /**
     * Edit AI Provider
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.providers.patch API Documentation
     *
     * @param AiProvider $aiProvider
     * @return AiProvider|null
     */
    public function updateProvider(AiProvider $aiProvider): ?AiProvider
    {
        $path = sprintf('ai/providers/%d', $aiProvider->getId());
        return $this->_update($path, $aiProvider);
    }

    /**
     * Delete AI Provider
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.providers.delete API Documentation
     *
     * @param int $aiProviderId
     * @return mixed
     */
    public function deleteProvider(int $aiProviderId)
    {
        $path = sprintf('ai/providers/%d', $aiProviderId);
        return $this->_delete($path);
    }

    /**
     * List AI Provider Models
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.providers.models.getMany API Documentation
     *
     * @param int $aiProviderId
     * @param array $params
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function listProviderModels(int $aiProviderId, array $params = []): ModelCollection
    {
        $path = sprintf('ai/providers/%d/models', $aiProviderId);
        return $this->_list($path, AiProviderModel::class, $params);
    }

    /**
     * Create AI Provider Chat Completion
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.providers.chat.completions.post API Documentation
     *
     * @param int $aiProviderId
     * @param array $data
     * string $data[model]<br>
     * boolean $data[stream]
     * @return AiProxyChatCompletion|null
     */
    public function createProviderChatCompletion(int $aiProviderId, array $data): ?AiProxyChatCompletion
    {
        $path = sprintf('ai/providers/%d/chat/completions', $aiProviderId);
        return $this->_post($path, AiProxyChatCompletion::class, $data);
    }

    /**
     * Generate AI Report
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.reports.post API Documentation
     *
     * @param array $data
     * string $data[type] required<br>
     * array $data[schema] required
     * @return AiReport|null
     */
    public function generateReport(array $data): ?AiReport
    {
        return $this->_post('ai/reports', AiReport::class, $data);
    }

    /**
     * Check AI Report Generation Status
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.reports.get API Documentation
     *
     * @param string $aiReportId
     * @return AiReport|null
     */
    public function getReport(string $aiReportId): ?AiReport
    {
        $path = sprintf('ai/reports/%s', $aiReportId);
        return $this->_get($path, AiReport::class);
    }

    /**
     * Download AI Report
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.reports.download.download API Documentation
     *
     * @param string $aiReportId
     * @return DownloadFile|null
     */
    public function downloadReport(string $aiReportId): ?DownloadFile
    {
        $path = sprintf('ai/reports/%s/download', $aiReportId);
        return $this->_get($path, DownloadFile::class);
    }

    /**
     * Get AI Settings
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.settings.get API Documentation
     *
     * @return AiSettings|null
     */
    public function getSettings(): ?AiSettings
    {
        return $this->_get('ai/settings', AiSettings::class);
    }

    /**
     * Edit AI Settings
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.settings.patch API Documentation
     *
     * @param AiSettings $aiSettings
     * @return AiSettings|null
     */
    public function updateSettings(AiSettings $aiSettings): ?AiSettings
    {
        return $this->_update('ai/settings', $aiSettings);
    }

    /**
     * List AI Snippets
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.settings.snippets.getMany API Documentation
     *
     * @param array $params
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function listSnippets(array $params = []): ModelCollection
    {
        return $this->_list('ai/settings/snippets', AiSnippet::class, $params);
    }

    /**
     * Add AI Snippet
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.settings.snippets.post API Documentation
     *
     * @param array $data
     * string $data[description] required<br>
     * string $data[placeholder] required<br>
     * string $data[value] required
     * @return AiSnippet|null
     */
    public function createSnippet(array $data): ?AiSnippet
    {
        return $this->_create('ai/settings/snippets', AiSnippet::class, $data);
    }

    /**
     * Get AI Snippet
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.settings.snippets.get API Documentation
     *
     * @param int $aiSnippetId
     * @return AiSnippet|null
     */
    public function getSnippet(int $aiSnippetId): ?AiSnippet
    {
        $path = sprintf('ai/settings/snippets/%d', $aiSnippetId);
        return $this->_get($path, AiSnippet::class);
    }

    /**
     * Edit AI Snippet
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.settings.snippets.patch API Documentation
     *
     * @param AiSnippet $aiSnippet
     * @return AiSnippet|null
     */
    public function updateSnippet(AiSnippet $aiSnippet): ?AiSnippet
    {
        $path = sprintf('ai/settings/snippets/%d', $aiSnippet->getId());
        return $this->_update($path, $aiSnippet);
    }

    /**
     * Delete AI Snippet
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.settings.snippets.delete API Documentation
     *
     * @param int $aiSnippetId
     * @return mixed
     */
    public function deleteSnippet(int $aiSnippetId)
    {
        $path = sprintf('ai/settings/snippets/%d', $aiSnippetId);
        return $this->_delete($path);
    }
}
