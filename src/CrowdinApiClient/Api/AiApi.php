<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\AiFileTranslation;
use CrowdinApiClient\Model\AiTranslation;
use CrowdinApiClient\Model\DownloadFile;

/**
 * Use API to leverage AI-powered translation of strings.
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
}
