<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\DownloadFile;
use CrowdinApiClient\Model\File;
use CrowdinApiClient\Model\FileRevision;
use CrowdinApiClient\ModelCollection;

/**
 * Use API to keep the source files up to date, check on file revisions
 *
 * @package Crowdin\Api
 */
class FileApi extends AbstractApi
{
    /**
     * List Files
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.files.getMany API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.files.getMany API Documentation Enterprise
     * @param int $projectId
     * @param array $params
     * integer $params[branchId] Can't be used with directoryId in the same request<br>
     * integer $params[directoryId] Can't be used with branchId in the same request<br>
     * mixed $params[recursion] Works only when directoryId or branchId parameter is specified<br>
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function list(int $projectId, array $params = []): ModelCollection
    {
        $path = sprintf('projects/%d/files', $projectId);
        return $this->_list($path, File::class, $params);
    }

    /**
     * Add File
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.files.post API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.files.post API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $data
     * integer $data[storageId] required<br>
     * string $data[name] required<br>
     * integer $data[branchId] Can't be used with directoryId in same request<br>
     * integer $data[directoryId] Can't be used with branchId in same request<br>
     * string $data[title]<br>
     * string $data[type]<br>
     * array $data[importOptions]<br>
     * array $data[exportOptions]
     * @return File
     */
    public function create(int $projectId, array $data): File
    {
        $path = sprintf('projects/%d/files', $projectId);
        return $this->_create($path, File::class, $data);
    }

    /**
     * Get File Info
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.files.get API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.files.get API Documentation Enterprise
     * @param int $projectId
     * @param int $fileId
     * @return File|null
     */
    public function get(int $projectId, int $fileId): ?File
    {
        $path = sprintf('projects/%d/files/%d', $projectId, $fileId);
        return $this->_get($path, File::class);
    }

    /**
     * Update File
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.files.put API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.files.put API Documentation Enterprise
     * @param int $projectId
     * @param int $fileId
     * @param array $data
     * array $data[storageId] required<br>
     * array $data[updateOption]<br>
     * array $data[importOptions]<br>
     * array $data[exportOptions]
     * @return File
     */
    public function update(int $projectId, int $fileId, array $data): File
    {
        $path = sprintf('projects/%d/files/%d', $projectId, $fileId);
        return $this->_put($path, File::class, $data);
    }

    /**
     * Restore file to revision
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.files.put API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.files.put API Documentation Enterprise
     * @param int $projectId
     * @param int $fileId
     * @param array $data
     * array $data[revisionId] required
     * @return File
     */
    public function restore(int $projectId, int $fileId, array $data): File
    {
        $path = sprintf('projects/%d/files/%d', $projectId, $fileId);
        return $this->_put($path, File::class, $data);
    }

    /**
     * Download File
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.files.download.get API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.files.download.get API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $fileId
     * @return DownloadFile|null
     */
    public function download(int $projectId, int $fileId): ?DownloadFile
    {
        $path = sprintf('projects/%d/files/%d/download', $projectId, $fileId);
        return $this->_get($path, DownloadFile::class);
    }

    /**
     * Edit File
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.files.patch API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.files.patch API Documentation Enterprise
     *
     * @param File $file
     * @return File|null
     */
    public function edit(File $file): ?File
    {
        $path = sprintf('projects/%d/files/%d', $file->getProjectId(), $file->getId());
        return $this->_update($path, $file);
    }

    /**
     * Delete File
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.files.delete API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.files.delete API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $fileId
     * @return mixed
     */
    public function delete(int $projectId, int $fileId)
    {
        $path = sprintf('projects/%d/files/%d', $projectId, $fileId);
        return $this->_delete($path);
    }

    /**
     * List File Revisions
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.files.revisions.getMany API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.files.revisions.getMany API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $fileId
     * @return ModelCollection
     */
    public function revisions(int $projectId, int $fileId): ModelCollection
    {
        $path = sprintf('projects/%d/files/%d/revisions', $projectId, $fileId);
        return $this->_list($path, FileRevision::class);
    }

    /**
     * Get File Revision
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.files.revisions.get API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.files.revisions.get API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $fileId
     * @param int $revision
     * @return FileRevision|null
     */
    public function getRevision(int $projectId, int $fileId, int $revision): ?FileRevision
    {
        $path = sprintf('projects/%d/files/%d/revisions/%d', $projectId, $fileId, $revision);
        return $this->_get($path, FileRevision::class);
    }
}
