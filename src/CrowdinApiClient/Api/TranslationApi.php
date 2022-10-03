<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Http\ResponseDecorator\ResponseArrayDecorator;
use CrowdinApiClient\Model\DownloadFile;
use CrowdinApiClient\Model\DownloadFileTranslation;
use CrowdinApiClient\Model\PreTranslation;
use CrowdinApiClient\Model\TranslationProjectBuild;
use CrowdinApiClient\ModelCollection;

/**
 * Translators can work with entirely untranslated project or you can pre-translate the files to ease the translations process.
 * Use API to pre-translate files via Machine Translation or Translation Memory, upload your existing translations, and download translations.
 * Pre-translate and build are asynchronous operations and shall be completed with sequence of API methods.
 *
 * @package Crowdin\Api
 */
class TranslationApi extends AbstractApi
{
    /**
     * Apply Pre-Translation
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.pre-translations.post API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.pre-translations.post API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $params
     * string[] $params[languageIds] required<br>
     * int[] $params[fileIds] required<br>
     * string $params[method]<br>
     * int $params[engineId]<br>
     * string $params[autoApproveOption]<br>
     * boolean $params[duplicateTranslations] Works only with TM pre-translation method<br>
     * boolean $params[translateUntranslatedOnly] Works only with TM pre-translation method<br>
     * boolean $params[translateWithPerfectMatchOnly] Works only with TM pre-translation method<br>
     * boolean $params[markAddedTranslationsAsDone]
     * @return PreTranslation|null
     */
    public function applyPreTranslation(int $projectId, array $params): ?PreTranslation
    {
        $path = sprintf('projects/%s/pre-translations', $projectId);
        return $this->_post($path, PreTranslation::class, $params);
    }

    /**
     * Pre-Translation Status
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.pre-translations.get  API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.pre-translations.get  API Documentation Enterprise
     *
     * @param int $projectId
     * @param string $preTranslationId
     * @return PreTranslation|null
     */
    public function getPreTranslation(int $projectId, string $preTranslationId): ?PreTranslation
    {
        $path = sprintf('projects/%d/pre-translations/%s', $projectId, $preTranslationId);

        return $this->_get($path, PreTranslation::class);
    }

    /**
     * Build Project File Translation
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.translations.builds.files.post API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.translations.builds.files.post API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $fileId
     * @param array $params
     * @param string|null $ifNoneMatch
     * @return DownloadFile|null
     * string $params[targetLanguageId]<br>
     * boolean $params[exportAsXliff]<br>
     * boolean $params[skipUntranslatedStrings] true value can't be used with skipUntranslatedFiles=true in same request<br>
     * boolean $params[skipUntranslatedFiles] true value can't be used with skipUntranslatedStrings=true in same request<br>
     * boolean $params[exportApprovedOnly]
     */
    public function buildProjectFileTranslation(int $projectId, int $fileId, array $params = [], string $ifNoneMatch = null): ?DownloadFile
    {
        $path = sprintf('projects/%d/translations/builds/files/%d', $projectId, $fileId);

        if ($ifNoneMatch) {
            $this->setHeader('If-None-Match', $ifNoneMatch);
        }

        return $this->_post($path, DownloadFileTranslation::class, $params);
    }

    /**
     * List Project Builds
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.translations.builds.getMany  API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.translations.builds.getMany  API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $params
     * integer $params[branchId]<br>
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function getProjectBuilds(int $projectId, array $params = []): ModelCollection
    {
        $path = sprintf('projects/%d/translations/builds', $projectId);

        return $this->_list($path, TranslationProjectBuild::class, $params);
    }

    /**
     * Build Project Translation
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.translations.builds.build API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.translations.builds.build API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $params
     * integer $params[branchId]<br>
     * array $params[targetLanguageIds]<br>
     * bool $params[skipUntranslatedStrings] true value can't be used with skipUntranslatedFiles=true in same request<br>
     * bool $params[skipUntranslatedFiles] true value can't be used with skipUntranslatedStrings=true in same request<br>
     * bool $params[exportApprovedOnly]<br>
     * integer $params[exportWithMinApprovalsCount]
     * @return TranslationProjectBuild|null
     */
    public function buildProject(int $projectId, array $params = []): ?TranslationProjectBuild
    {
        $path = sprintf('projects/%d/translations/builds', $projectId);

        return $this->_post($path, TranslationProjectBuild::class, $params);
    }

    /**
     * Upload Translations
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.translations.post  API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.translations.post  API Documentation Enterprise
     *
     * @param int $projectId
     * @param string $languageId
     * @param array $params
     *  integer $params[storageId] required<br>
     *  integer $params[fileId] required<br>
     *  bool $params[importEqSuggestions]<br>
     *  bool $params[autoApproveImported]<br>
     *  bool $params[markAddedTranslationsAsDone]
     * @return array
     */
    public function uploadTranslations(int $projectId, string $languageId, array $params): array
    {
        $path = sprintf('projects/%d/translations/%s', $projectId, $languageId);

        $options = [
            'body' => json_encode($params),
            'headers' => $this->getHeaders(),
        ];

        return $this->client->apiRequest('post', $path, new ResponseArrayDecorator(), $options);
    }

    /**
     * Download Project Translations
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.translations.builds.download.download API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.translations.builds.download.download API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $buildId
     * @return DownloadFile|null
     */
    public function downloadProjectBuild(int $projectId, int $buildId): ?DownloadFile
    {
        $path = sprintf('projects/%d/translations/builds/%d/download', $projectId, $buildId);
        return $this->_get($path, DownloadFile::class);
    }

    /**
     * Check Project Build Status
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.translations.builds.get  API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.translations.builds.get  API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $buildId
     * @return TranslationProjectBuild|null
     */
    public function getProjectBuildStatus(int $projectId, int $buildId): ?TranslationProjectBuild
    {
        $path = sprintf('projects/%d/translations/builds/%d', $projectId, $buildId);

        return $this->_get($path, TranslationProjectBuild::class);
    }

    /**
     * Cancel Build
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.translations.builds.delete  API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.translations.builds.delete  API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $buildId
     * @return mixed
     */
    public function deleteProjectBuild(int $projectId, int $buildId)
    {
        $path = sprintf('projects/%d/translations/builds/%d', $projectId, $buildId);
        return $this->_delete($path);
    }

    /**
     * Export Project Translation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.translations.exports.post API Documentation
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.translations.exports.post API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $params
     * string $params[targetLanguageId] required<br>
     * string $params[format]<br>
     * int[] $params[branchIds] Note: Can't be used with directoryIds or fileIds in same request<br>
     * int[] $params[directoryIds] Note: Can't be used with branchIds or fileIds in same request<br>
     * int[] $params[fileIds] Note: Can't be used with branchIds or directoryIds in same request<br>
     * bool $params[skipUntranslatedStrings] Note: Can't be used with skipUntranslatedFiles in same request<br>
     * bool $params[skipUntranslatedFiles] Note: Can't be used with skipUntranslatedStrings in same request<br>
     * bool $params[exportApprovedOnly]<br>
     * integer $params[exportWithMinApprovalsCount]
     *
     * @return DownloadFile
     */
    public function exportProjectTranslation(int $projectId, array $params = []): DownloadFile
    {
        $path = sprintf('projects/%d/translations/exports', $projectId);
        return $this->_post($path, DownloadFile::class, $params);
    }
}
