<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\Issue;
use CrowdinApiClient\Model\Progress;
use CrowdinApiClient\Model\ProgressFile;
use CrowdinApiClient\Model\QaCheck;
use CrowdinApiClient\ModelCollection;

/**
 * Class TranslationStatusApi
 * @package CrowdinApiClient\Api
 */
class TranslationStatusApi extends AbstractApi
{
    /**
     * List Reported Issues
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.issues.getMany API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.issues.getMany API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $params
     * @internal integer $params[limit] default 25
     * @internal integer $params[offset] default 0
     * @return Issue|null
     */
    public function listReportedIssues(int $projectId, array $params = []): ?ModelCollection
    {
        $path = sprintf('projects/%d/issues', $projectId);
        return $this->_list($path, Issue::class, $params);
    }

    /**
     * Get Branch Progress
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.branches.languages.progress.getMany API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.branches.languages.progress.getMany API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $branchId
     * @param array $params
     * @internal integer $params[limit] default 25
     * @internal integer $params[offset] default 0
     * @return ModelCollection|null
     */
    public function getBranchProgress(int $projectId, int $branchId, array $params = []): ?ModelCollection
    {
        $path = sprintf('projects/%d/branches/%d/languages/progress', $projectId, $branchId);
        return $this->_list($path, Progress::class, $params);
    }

    /**
     * Get Directory Progress
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.directories.languages.progress.getMany API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.directories.languages.progress.getMany API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $directoryId
     * @param array $params
     * @internal integer $params[limit] default 25
     * @internal integer $params[offset] default 0
     * @return ModelCollection|null
     */
    public function getDirectoryProgress(int $projectId, int $directoryId, array $params = []): ?ModelCollection
    {
        $path = sprintf('projects/%d/directories/%d/languages/progress', $projectId, $directoryId);
        return $this->_list($path, Progress::class, $params);
    }

    /**
     * Get File Progress
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.files.languages.progress.getMany API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.files.languages.progress.getMany API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $fileId
     * @param array $params
     * @internal integer $params[limit] default 25
     * @internal integer $params[offset] default 0
     * @return ModelCollection|null
     */
    public function getFileProgress(int $projectId, int $fileId, array $params = []): ?ModelCollection
    {
        $path = sprintf('projects/%d/files/%d/languages/progress', $projectId, $fileId);
        return $this->_list($path, ProgressFile::class, $params);
    }

    /**
     * Get Project Progress
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.languages.progress.getMany API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.languages.progress.getMany API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $params
     * @internal integer $params[limit] default 25
     * @internal integer $params[offset] default 0
     * @internal string $params[languageIds]
     * @return ModelCollection|null
     */
    public function getProjectProgress(int $projectId, array $params = []): ?ModelCollection
    {
        $path = sprintf('projects/%d/languages/progress', $projectId);
        return $this->_list($path, Progress::class, $params);
    }

    /**
     * List QA Check Issues
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.qa-check.getMany API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.qa-check.getMany API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $params
     * @internal integer $params[limit] default 25
     * @internal integer $params[offset] default 0
     * @internal string $params[category]
     * @internal string $params[validation]
     * @internal string $params[languageIds]
     * @return ModelCollection|null
     */
    public function listQACheckIssues(int $projectId, array $params = []): ?ModelCollection
    {
        $path = sprintf('projects/%d/qa-check', $projectId);
        return $this->_list($path, QaCheck::class, $params);
    }
}
