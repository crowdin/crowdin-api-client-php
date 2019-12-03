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
