<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\Issue;
use CrowdinApiClient\Model\Progress;
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
     * @return ModelCollection|null
     */
    public function getBranchProgress(int $projectId, int $branchId): ?ModelCollection
    {
        $path = sprintf('projects/%d/branches/%d/languages/progress', $projectId, $branchId);
        return $this->_list($path, Progress::class);
    }

    /**
     * Get Directory Progress
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.directories.languages.progress.getMany API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.directories.languages.progress.getMany API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $directoryId
     * @return ModelCollection|null
     */
    public function getDirectoryProgress(int $projectId, int $directoryId): ?ModelCollection
    {
        $path = sprintf('projects/%d/directories/%d/languages/progress', $projectId, $directoryId);
        return $this->_list($path, Progress::class);
    }

    /**
     * Get File Progress
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.files.languages.progress.getMany API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.files.languages.progress.getMany API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $fileId
     * @return ModelCollection|null
     */
    public function getFileProgress(int $projectId, int $fileId): ?ModelCollection
    {
        $path = sprintf('projects/%d/files/%d/languages/progress', $projectId, $fileId);
        return $this->_list($path, Progress::class);
    }

    /**
     * Get Project Progress
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.languages.progress.getMany API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.languages.progress.getMany API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $languageIds
     * @return ModelCollection|null
     */
    public function getProjectProgress(int $projectId, array $languageIds = []): ?ModelCollection
    {
        $path = sprintf('projects/%d/languages/progress', $projectId);
        return $this->_list($path, Progress::class, ['languageIds' => $languageIds]);
    }

    /**
     * List QA Check Issues
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.qa-check.getMany API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.qa-check.getMany API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $params
     * @return ModelCollection|null
     */
    public function listQACheckIssues(int $projectId, array $params = []): ?ModelCollection
    {
        $path = sprintf('projects/%d/qa-check', $projectId);
        return $this->_list($path, QaCheck::class, $params);
    }
}
