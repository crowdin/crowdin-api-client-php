<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\Progress;
use CrowdinApiClient\Model\ProgressFile;
use CrowdinApiClient\Model\ProgressLanguage;
use CrowdinApiClient\Model\QaCheck;
use CrowdinApiClient\ModelCollection;

/**
 * Class TranslationStatusApi
 * @package Crowdin\Api
 */
class TranslationStatusApi extends AbstractApi
{
    /**
     * Get Branch Progress
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.branches.languages.progress.getMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.branches.languages.progress.getMany API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $branchId
     * @param array $params
     * integer $params[limit] default 25<br>
     * integer $params[offset] default 0
     * @return ModelCollection|null
     */
    public function getBranchProgress(int $projectId, int $branchId, array $params = []): ?ModelCollection
    {
        $path = sprintf('projects/%d/branches/%d/languages/progress', $projectId, $branchId);
        return $this->_list($path, Progress::class, $params);
    }

    /**
     * Get Directory Progress
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.directories.languages.progress.getMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.directories.languages.progress.getMany API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $directoryId
     * @param array $params
     * integer $params[limit] default 25<br>
     * integer $params[offset] default 0
     * @return ModelCollection|null
     */
    public function getDirectoryProgress(int $projectId, int $directoryId, array $params = []): ?ModelCollection
    {
        $path = sprintf('projects/%d/directories/%d/languages/progress', $projectId, $directoryId);
        return $this->_list($path, Progress::class, $params);
    }

    /**
     * Get File Progress
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.files.languages.progress.getMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.files.languages.progress.getMany API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $fileId
     * @param array $params
     * integer $params[limit] default 25<br>
     * integer $params[offset] default 0
     * @return ModelCollection|null
     */
    public function getFileProgress(int $projectId, int $fileId, array $params = []): ?ModelCollection
    {
        $path = sprintf('projects/%d/files/%d/languages/progress', $projectId, $fileId);
        return $this->_list($path, ProgressFile::class, $params);
    }

    /**
     * Get Language Progress
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.languages.files.progress.getMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.files.languages.progress.getMany API Documentation Enterprise
     *
     * @param int $projectId
     * @param string $languageId
     * @param array $params
     * integer $params[limit] default 25<br>
     * integer $params[offset] default 0
     * @return ModelCollection|null
     */
    public function getLanguageProgress(int $projectId, string $languageId, array $params = []): ?ModelCollection
    {
        $path = sprintf('projects/%d/languages/%s/progress', $projectId, $languageId);
        return $this->_list($path, ProgressLanguage::class, $params);
    }

    /**
     * Get Project Progress
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.languages.progress.getMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.languages.progress.getMany API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $params
     * integer $params[limit] default 25<br>
     * integer $params[offset] default 0<br>
     * string $params[languageIds]
     * @return ModelCollection|null
     */
    public function getProjectProgress(int $projectId, array $params = []): ?ModelCollection
    {
        $path = sprintf('projects/%d/languages/progress', $projectId);
        return $this->_list($path, Progress::class, $params);
    }

    /**
     * List QA Check Issues
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.qa-check.getMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.qa-check.getMany API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $params
     * integer $params[limit] default 25<br>
     * integer $params[offset] default 0<br>
     * string $params[category]<br>
     * string $params[validation]<br>
     * string $params[languageIds]
     * @return ModelCollection|null
     */
    public function listQACheckIssues(int $projectId, array $params = []): ?ModelCollection
    {
        $path = sprintf('projects/%d/qa-checks', $projectId);
        return $this->_list($path, QaCheck::class, $params);
    }
}
