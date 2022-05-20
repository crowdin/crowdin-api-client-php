<?php

declare(strict_types=1);

namespace CrowdinApiClient\Api\Enterprise;

use CrowdinApiClient\Api\FileApi as CrowdinFileApi;
use CrowdinApiClient\Model\DownloadFile;
use CrowdinApiClient\Model\Enterprise\ReviewedSourceFileBuild;
use CrowdinApiClient\ModelCollection;

/**
 * Use API to keep the source files up to date, check on file revisions
 *
 * @package Crowdin\Api\Enterprise
 */
class FileApi extends CrowdinFileApi
{
    /**
     * List Reviewed Source Files Builds
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.strings.reviewed-builds.getMany API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $params
     * @internal integer $params[branchId]
     * @internal integer $params[limit]
     * @internal integer $params[offset]
     * @return ModelCollection
     */
    public function listReviewedSourceFilesBuilds(int $projectId, array $params = []): ModelCollection
    {
        $path = sprintf('projects/%d/strings/reviewed-builds', $projectId);
        return $this->_list($path, ReviewedSourceFileBuild::class, $params);
    }

    /**
     * Build Reviewed Source Files
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.strings.reviewed-builds.post API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $data
     * @internal integer $data[branchId]
     * @return ReviewedSourceFileBuild
     */
    public function buildReviewedSourceFiles(int $projectId, array $data = []): ReviewedSourceFileBuild
    {
        $path = sprintf('projects/%d/strings/reviewed-builds', $projectId);
        return $this->_create($path, ReviewedSourceFileBuild::class, $data);
    }

    /**
     * Check Reviewed Source Files Build Status
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.strings.reviewed-builds.get API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $buildId
     * @return ReviewedSourceFileBuild
     */
    public function checkReviewedSourceFilesBuildStatus(int $projectId, int $buildId): ReviewedSourceFileBuild
    {
        $path = sprintf('projects/%d/strings/reviewed-builds/%d', $projectId, $buildId);
        return $this->_get($path, ReviewedSourceFileBuild::class);
    }

    public function downloadReviewedSourceFiles(int $projectId, int $buildId): DownloadFile
    {
        $path = sprintf('projects/%d/strings/reviewed-builds/%d/download', $projectId, $buildId);
        return $this->_get($path, DownloadFile::class);
    }
}
