<?php

namespace CrowdinApiClient\Api\Enterprise;

use CrowdinApiClient\Api\AbstractApi;
use CrowdinApiClient\Model\AiFileTranslation;
use CrowdinApiClient\Model\AiTranslation;
use CrowdinApiClient\Model\DownloadFile;

/**
 * Use API to leverage AI-powered translation of strings.
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
}
