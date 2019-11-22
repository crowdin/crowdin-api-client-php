<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\DownloadFile;
use CrowdinApiClient\Model\File;
use CrowdinApiClient\Model\FileRevision;
use CrowdinApiClient\ModelCollection;

/**
 * Class FileApi
 * @package Crowdin\Api
 */
class FileApi extends AbstractApi
{
    /**
     * @param int $projectId
     * @param array $params
     * @return ModelCollection
     */
    public function list(int $projectId, array $params = []): ModelCollection
    {
        $path = sprintf('projects/%d/files', $projectId);
        return $this->_list($path, File::class, $params);
    }

    /**
     * @param int $projectId
     * @param array $data
     * @internal integer $data[storageId] required
     * @internal string $data[name] required
     * @internal integer $data[branchId]
     * @internal integer $data[directoryId]
     * @internal string $data[title]
     * @internal string $data[type]
     * @return File
     */
    public function create(int $projectId, array $data):File
    {
        $path = sprintf('projects/%d/files', $projectId);
        return $this->_create($path, File::class, $data);
    }

    /**
     * @param int $projectId
     * @param $fileId
     * @return File|null
     */
    public function get(int $projectId, int $fileId): ?File
    {
        $path = sprintf('projects/%d/files/%d', $projectId, $fileId);
        return $this->_get($path, File::class);
    }

    /**
     * @param int $projectId
     * @param $fileId
     * @return DownloadFile|null
     */
    public function download(int $projectId, int $fileId): ?DownloadFile
    {
        $path = sprintf('projects/%d/files/%d/download', $projectId, $fileId);
        return $this->_get($path, DownloadFile::class);
    }

    /**
     * @param File $file
     * @return File|null
     */
    public function update(File $file): ?File
    {
        $path = sprintf('projects/%d/files/%d', $file->getProjectId(), $file->getId());
        return $this->_update($path, $file);
    }

    /**
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
     * @param int $projectId
     * @param int $fileId
     * @param int $revision
     * @return File|null
     */
    public function restoreFileToRevision(int $projectId, int $fileId, int $revision = 0): ?File
    {
        $path = sprintf('projects/%d/files/%d/restore', $projectId, $fileId);
        return $this->_put($path, File::class, ['revision' => $revision]);
    }

    /**
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

    /**
     * @param int $projectId
     * @param int $fileId
     * @param array $data
     * @return File|null
     */
    public function updateFileRevision(int $projectId, int $fileId, array $data): ?File
    {
        $path = sprintf('projects/%d/files/%d/update', $projectId, $fileId);
        return $this->_create($path, File::class, $data);
    }
}
