<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Http\ResponseDecorator\ResponseArrayDecorator;
use CrowdinApiClient\Model\DownloadFile;
use CrowdinApiClient\Model\DownloadFileTranslation;
use CrowdinApiClient\Model\PreTranslation;
use CrowdinApiClient\Model\TranslationProjectBuild;
use CrowdinApiClient\ModelCollection;

class TranslationApi extends AbstractApi
{
    /**
     * Apply Pre-Translation
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.pre-translations.post API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.pre-translations.post API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $params
     * @return PreTranslation|null
     */
    public function applyPreTranslation(int $projectId, array $params): ?PreTranslation
    {
        $path = sprintf('projects/%s/pre-translations', $projectId);
        return $this->_post($path, PreTranslation::class, $params);
    }

    /**
     * Pre-Translation Status
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.pre-translations.get  API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.pre-translations.get  API Documentation Enterprise
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
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.translations.builds.files.post API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.translations.builds.files.post API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $fileId
     * @param string $targetLanguageId
     * @param bool $exportAsXliff
     * @param array $params
     * @return DownloadFile|null
     */
    public function buildProjectFileTranslation(int $projectId, int $fileId, string $targetLanguageId, bool $exportAsXliff = false, array $params = []): ?DownloadFile
    {
        $path = sprintf('projects/%d/translations/builds/files/%d', $projectId, $fileId);

        $data = [
            'targetLanguageId' => $targetLanguageId,
            'exportAsXliff' => $exportAsXliff,
            'skipUntranslatedStrings' => $params['skipUntranslatedStrings'] ?? false,
            'skipUntranslatedFiles' => $params['skipUntranslatedFiles'] ?? false,
            'exportApprovedOnly' => $params['exportApprovedOnly'] ?? false,
        ];
        return $this->_post($path, DownloadFileTranslation::class, $data);
    }

    /**
     * List Project Builds
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.translations.builds.getMany  API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.translations.builds.getMany  API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $params
     * @return ModelCollection
     */
    public function getProjectBuilds(int $projectId, array $params = []): ModelCollection
    {
        $path = sprintf('projects/%d/translations/builds', $projectId);

        return $this->_list($path, TranslationProjectBuild::class, $params);
    }

    /**
     * Check Project Build Status
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.translations.builds.get  API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.translations.builds.get  API Documentation Enterprise
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
     * Download Project Translations
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.translations.builds.download.download API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.translations.builds.download.download API Documentation Enterprise
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
     * Cancel Build
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.translations.builds.delete  API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.translations.builds.delete  API Documentation Enterprise
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
     * Upload Translations
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.translations.post  API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.translations.post  API Documentation Enterprise
     *
     * @param int $projectId
     * @param string $languageId
     * @param array $params
     * @internal  integer $params[storageId] required
     * @internal  integer $params[fileId] required
     * @internal  bool $params[importDuplicates]
     * @internal  bool $params[importEqSuggestions]
     * @internal  bool $params[autoApproveImported]
     * @internal  bool $params[markAddedTranslationsAsDone]
     * @return array
     */
    public function uploadTranslations(int $projectId, string $languageId, array $params): array
    {
        $path = sprintf('projects/%d/translations/%s', $projectId, $languageId);

        $options = [
            'body' => json_encode($params),
            'headers' => ['Content-Type' => 'application/json']
        ];

        return $this->client->apiRequest('post', $path, new ResponseArrayDecorator(), $options);
    }

    /**
     * Build Project Translation
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.translations.builds.build API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.translations.builds.build API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $params
     * @internal integer $params[branchId]
     * @internal integer $params[branchId]
     * @internal array $params[targetLanguageIds]
     * @internal bool $params[skipUntranslatedStrings]
     * @internal bool $params[skipUntranslatedFiles]
     * @internal bool $params[exportApprovedOnly]
     * @return TranslationProjectBuild|null
     */
    public function buildProject(int $projectId, array $params = []): ?TranslationProjectBuild
    {
        $patch = sprintf('projects/%d/translations/builds', $projectId);

        return $this->_post($patch, TranslationProjectBuild::class, $params);
    }
}
