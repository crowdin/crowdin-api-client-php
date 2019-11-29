<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Http\ResponseDecorator\ResponseArrayDecorator;
use CrowdinApiClient\Model\DownloadFile;
use CrowdinApiClient\Model\PreTranslation;
use CrowdinApiClient\Model\TranslationProjectBuild;
use CrowdinApiClient\ModelCollection;

class TranslationApi extends AbstractApi
{
    /**
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
     * @param int $projectId
     * @param int $fileId
     * @param string $targetLanguageId
     * @param bool $exportAsXliff
     * @return DownloadFile|null
     */
    public function buildProjectFileTranslation(int $projectId, int $fileId, string $targetLanguageId, bool $exportAsXliff = false): ?DownloadFile
    {
        $path = sprintf('projects/%d/translations/builds/files/%d', $projectId, $fileId);

        $data = [
            'targetLanguageId' => $targetLanguageId,
            'exportAsXliff' => $exportAsXliff
        ];
        return $this->_post($path, DownloadFile::class, $data);
    }

    /**
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
     * @param int $projectId
     * @param array $params
     * @internal integer $params[branchId]
     * @internal array $params[targetLanguageIds]
     * @internal bool $params[exportTranslatedOnly]
     * @internal bool $params[exportApprovedOnly]
     * @return TranslationProjectBuild|null
     */
    public function buildProject(int $projectId, array $params = []): ?TranslationProjectBuild
    {
        $patch = sprintf('projects/%d/translations/builds', $projectId);

        return $this->_post($patch, TranslationProjectBuild::class, $params);
    }

    /**
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
     * @param int $projectId
     * @param string $languageId
     * @param array $params
     * @return array
     */
    public function uploadTranslations(int $projectId, string $languageId, array $params): array
    {
        $path = sprintf('projects/%d/translations/%s', $projectId, $languageId);

        return $this->client->apiRequest('post', $path, new ResponseArrayDecorator(), $params);
    }
}
