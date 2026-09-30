<?php

namespace CrowdinApiClient\Api\Enterprise;

use CrowdinApiClient\Api\AbstractApi;
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
     * List AI Request Logs
     * @link https://developer.crowdin.com/api/v2/#operation/api.ai.requestLogs.getMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.requestLogs.getMany API Documentation Enterprise
     *
     * @param array $params
     * string $params[requestId] Filter by request identifier<br>
     * integer $params[projectId] Filter by project<br>
     * integer $params[userId] Filter by the user attributed to the AI request<br>
     * integer $params[aiProviderId] Filter by AI provider<br>
     * string $params[model] Filter by model name<br>
     * string $params[sourceAction] Filter by the feature or channel that produced the request. Enum: "ai_proxy" "ai_gateway" "ai_translate_strings" "ai_file_translate" "ai_prompt_completion" "pre_translate:manual" "pre_translate:workflow" "ai_alignment" "qa_check" "ai_suggestion" "advisor"<br>
     * string $params[promptAction] Filter by prompt action<br>
     * string $params[statuses] Comma-separated request statuses. Enum: "pending" "success" "error" "timeout"<br>
     * boolean $params[systemCredentials] Filter by whether system-provided credentials were used<br>
     * boolean $params[isAutoTriggered] Filter by whether the request was triggered automatically<br>
     * string $params[tokenName] Filter by personal access token name<br>
     * string $params[oauthClientId] Filter by OAuth client identifier<br>
     * string $params[createdAfter] Return logs created after this date-time<br>
     * string $params[createdBefore] Return logs created before this date-time<br>
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function listRequestLogs(array $params = []): ModelCollection
    {
        return $this->_list('ai/request-logs', AiRequestLog::class, $params);
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
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.prompts.snippets.getMany API Documentation
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
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.prompts.snippets.post API Documentation
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
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.prompts.snippets.get API Documentation
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
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.prompts.snippets.patch API Documentation
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
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.prompts.snippets.delete API Documentation
     *
     * @param int $aiSnippetId
     * @return mixed
     */
    public function deleteSnippet(int $aiSnippetId)
    {
        $path = sprintf('ai/settings/snippets/%d', $aiSnippetId);
        return $this->_delete($path);
    }

    /**
     * Get Project AI Settings
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.ai.settings.get API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.ai.settings.get API Documentation Enterprise
     *
     * @param int $projectId
     * @return ProjectAiSettings|null
     */
    public function getProjectSettings(int $projectId): ?ProjectAiSettings
    {
        $path = sprintf('projects/%d/ai/settings', $projectId);
        return $this->_get($path, ProjectAiSettings::class);
    }

    /**
     * Generate AI Prompt Fine-Tuning Dataset
     * @link https://developer.crowdin.com/api/v2/#operation/api.ai.prompts.fine-tuning.datasets.post API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.prompts.fine-tuning.datasets.post API Documentation Enterprise
     *
     * @param int $aiPromptId
     * @param array $data
     * int[] $data[projectIds]<br>
     * int[] $data[tmIds]<br>
     * string $data[purpose] Enum: "training" "validation"<br>
     * string $data[dateFrom]<br>
     * string $data[dateTo]<br>
     * integer $data[maxFileSize]<br>
     * integer $data[minExamplesCount]<br>
     * integer $data[maxExamplesCount]
     * @return AiFineTuningDataset|null
     */
    public function generateFineTuningDataset(int $aiPromptId, array $data): ?AiFineTuningDataset
    {
        $path = sprintf('ai/prompts/%d/fine-tuning/datasets', $aiPromptId);
        return $this->_post($path, AiFineTuningDataset::class, $data);
    }

    /**
     * Get AI Prompt Fine-Tuning Dataset Generation Status
     * @link https://developer.crowdin.com/api/v2/#operation/api.users.ai.prompts.fine-tuning.datasets.get API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.prompts.fine-tuning.datasets.get API Documentation Enterprise
     *
     * @param int $aiPromptId
     * @param string $jobIdentifier
     * @return AiFineTuningDataset|null
     */
    public function getFineTuningDataset(int $aiPromptId, string $jobIdentifier): ?AiFineTuningDataset
    {
        $path = sprintf('ai/prompts/%d/fine-tuning/datasets/%s', $aiPromptId, $jobIdentifier);
        return $this->_get($path, AiFineTuningDataset::class);
    }

    /**
     * Download AI Prompt Fine-Tuning Dataset
     * @link https://developer.crowdin.com/api/v2/#operation/api.users.ai.prompts.fine-tuning.datasets.download.get API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.prompts.fine-tuning.datasets.download.get API Documentation Enterprise
     *
     * @param int $aiPromptId
     * @param string $jobIdentifier
     * @return DownloadFile|null
     */
    public function downloadFineTuningDataset(int $aiPromptId, string $jobIdentifier): ?DownloadFile
    {
        $path = sprintf('ai/prompts/%d/fine-tuning/datasets/%s/download', $aiPromptId, $jobIdentifier);
        return $this->_get($path, DownloadFile::class);
    }

    /**
     * List AI Prompt Fine-Tuning Jobs
     * @link https://developer.crowdin.com/api/v2/#operation/api.ai.prompts.fine-tuning.jobs.getMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.prompts.fine-tuning.jobs.getMany API Documentation Enterprise
     *
     * @param array $params
     * string $params[statuses] Comma-separated list of statuses<br>
     * string $params[orderBy]<br>
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function listFineTuningJobs(array $params = []): ModelCollection
    {
        $path = 'ai/prompts/fine-tuning/jobs';
        return $this->_list($path, AiFineTuningJob::class, $params);
    }

    /**
     * Create AI Prompt Fine-Tuning Job
     * @link https://developer.crowdin.com/api/v2/#operation/api.ai.prompts.fine-tuning.jobs.post API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.prompts.fine-tuning.jobs.post API Documentation Enterprise
     *
     * @param int $aiPromptId
     * @param array $data
     * boolean $data[dryRun]<br>
     * array $data[hyperparameters] batchSize, learningRateMultiplier, nEpochs<br>
     * array $data[trainingOptions] required. projectIds, tmIds, dateFrom, dateTo, maxFileSize, minExamplesCount, maxExamplesCount<br>
     * array $data[validationOptions] same keys as trainingOptions
     * @return AiFineTuningJob|null
     */
    public function createFineTuningJob(int $aiPromptId, array $data): ?AiFineTuningJob
    {
        $path = sprintf('ai/prompts/%d/fine-tuning/jobs', $aiPromptId);
        return $this->_post($path, AiFineTuningJob::class, $data);
    }

    /**
     * Get AI Prompt Fine-Tuning Job Status
     * @link https://developer.crowdin.com/api/v2/#operation/api.users.ai.prompts.fine-tuning.jobs.get API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.prompts.fine-tuning.jobs.get API Documentation Enterprise
     *
     * @param int $aiPromptId
     * @param string $jobIdentifier
     * @return AiFineTuningJob|null
     */
    public function getFineTuningJob(int $aiPromptId, string $jobIdentifier): ?AiFineTuningJob
    {
        $path = sprintf('ai/prompts/%d/fine-tuning/jobs/%s', $aiPromptId, $jobIdentifier);
        return $this->_get($path, AiFineTuningJob::class);
    }

    /**
     * List AI Prompt Fine-Tuning Events
     * @link https://developer.crowdin.com/api/v2/#operation/api.ai.prompts.fine-tuning.jobs.events.getMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.prompts.fine-tuning.jobs.events.getMany API Documentation Enterprise
     *
     * @param int $aiPromptId
     * @param string $jobIdentifier
     * @return ModelCollection
     */
    public function listFineTuningEvents(int $aiPromptId, string $jobIdentifier): ModelCollection
    {
        $path = sprintf('ai/prompts/%d/fine-tuning/jobs/%s/events', $aiPromptId, $jobIdentifier);
        return $this->_list($path, AiFineTuningEvent::class);
    }

    /**
     * List AI Provider Models (across all providers)
     * @link https://developer.crowdin.com/api/v2/#operation/api.ai.providers.models.crowdin.getMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.providers.models.enterprise.getMany API Documentation Enterprise
     *
     * @return ModelCollection
     */
    public function listAllProviderModels(): ModelCollection
    {
        $path = 'ai/providers/models';
        return $this->_list($path, AiProviderModel::class);
    }

    /**
     * List Supported AI Provider Models
     * @link https://developer.crowdin.com/api/v2/#operation/api.ai.providers.supported-models.crowdin.getMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.providers.supported-models.enterprise.getMany API Documentation Enterprise
     *
     * @param array $params
     * string $params[providerType]<br>
     * boolean $params[enabled]<br>
     * string $params[orderBy]<br>
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function listSupportedProviderModels(array $params = []): ModelCollection
    {
        $path = 'ai/providers/supported-models';
        return $this->_list($path, AiSupportedModel::class, $params);
    }

    /**
     * Export AI Request Logs
     * @link https://developer.crowdin.com/api/v2/#operation/api.ai.requestLogs.exports.post API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.requestLogs.exports.post API Documentation Enterprise
     *
     * @param array $data
     * string $data[format] Enum: "csv"<br>
     * string $data[requestId]<br>
     * integer $data[projectId]<br>
     * integer $data[userId]<br>
     * integer $data[aiProviderId]<br>
     * string $data[model]<br>
     * string $data[sourceAction]<br>
     * string $data[promptAction]<br>
     * string[] $data[statuses]<br>
     * string $data[tokenName]<br>
     * string $data[oauthClientId]<br>
     * boolean $data[systemCredentials]<br>
     * boolean $data[isAutoTriggered]<br>
     * string $data[createdAfter]<br>
     * string $data[createdBefore]
     * @return AiRequestLogExport|null
     */
    public function exportRequestLogs(array $data): ?AiRequestLogExport
    {
        $path = 'ai/request-logs/exports';
        return $this->_post($path, AiRequestLogExport::class, $data);
    }

    /**
     * Check AI Request Logs Export Status
     * @link https://developer.crowdin.com/api/v2/#operation/api.ai.requestLogs.exports.get API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.requestLogs.exports.get API Documentation Enterprise
     *
     * @param string $exportId
     * @return AiRequestLogExport|null
     */
    public function getRequestLogsExport(string $exportId): ?AiRequestLogExport
    {
        $path = sprintf('ai/request-logs/exports/%s', $exportId);
        return $this->_get($path, AiRequestLogExport::class);
    }

    /**
     * Download AI Request Logs Export
     * @link https://developer.crowdin.com/api/v2/#operation/api.ai.requestLogs.exports.download API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.requestLogs.exports.download API Documentation Enterprise
     *
     * @param string $exportId
     * @return DownloadFile|null
     */
    public function downloadRequestLogsExport(string $exportId): ?DownloadFile
    {
        $path = sprintf('ai/request-logs/exports/%s/download', $exportId);
        return $this->_get($path, DownloadFile::class);
    }

    /**
     * List AI Usage Members
     * @link https://developer.crowdin.com/api/v2/#operation/api.ai.usage.members.getMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.usage.members.getMany API Documentation Enterprise
     *
     * @param array $params
     * string $params[userIds] Comma-separated list of user ids<br>
     * string $params[orderBy]<br>
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function listUsageMembers(array $params = []): ModelCollection
    {
        $path = 'ai/usage/members';
        return $this->_list($path, AiMemberUsage::class, $params);
    }

    /**
     * Get AI Usage Member
     * @link https://developer.crowdin.com/api/v2/#operation/api.ai.usage.members.get API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.usage.members.get API Documentation Enterprise
     *
     * @param int $memberId
     * @return AiMemberUsage|null
     */
    public function getUsageMember(int $memberId): ?AiMemberUsage
    {
        $path = sprintf('ai/usage/members/%d', $memberId);
        return $this->_get($path, AiMemberUsage::class);
    }
}
