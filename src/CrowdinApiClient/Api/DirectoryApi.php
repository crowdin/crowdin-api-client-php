<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\Directory;
use CrowdinApiClient\ModelCollection;

/**
 * Class DirectoryApi
 * @package Crowdin\Api
 */
class DirectoryApi extends AbstractApi
{
    /**
     * List Directories
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.directories.getMany API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.directories.getMany API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $params
     * @internal integer $params[branchId]
     * @internal integer $params[directoryId]
     * @internal integer $params[recursion]
     * @internal integer $params[limit]
     * @internal integer $params[offset]
     * @return ModelCollection
     */
    public function list(int $projectId, array $params = []): ModelCollection
    {
        $path = sprintf('projects/%d/directories', $projectId);
        return $this->_list($path, Directory::class, $params);
    }

    /**
     * Get Directory Info
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.directories.get  API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.directories.get  API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $directoryId
     * @return Directory|null
     */
    public function get(int $projectId, int $directoryId): ?Directory
    {
        $path = sprintf('projects/%d/directories/%d', $projectId, $directoryId);
        return  $this->_get($path, Directory::class);
    }

    /**
     * Add Directory
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.directories.post API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.directories.post API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $data
     * @internal string $data[name] required
     * @internal integer $data[branchId]
     * @internal integer $data[parentId]
     * @internal string $data[title]
     * @internal string $data[exportPattern]
     * @internal string $data[priority] Enum: "low" "normal" "high"
     * @return Directory|null
     */
    public function create(int $projectId, array $data): ?Directory
    {
        $path = sprintf('projects/%d/directories', $projectId);
        return $this->_create($path, Directory::class, $data);
    }

    /**
     * Edit Directory
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.directories.patch  API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.directories.patch  API Documentation Enterprise
     *
     * @param Directory $directory
     * @return Directory|null
     */
    public function update(Directory $directory): ?Directory
    {
        $path = sprintf('projects/%d/directories/%d', $directory->getProjectId(), $directory->getId());
        return $this->_update($path, $directory);
    }

    /**
     * Delete Directory
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.directories.delete  API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.directories.delete  API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $directoryId
     * @return mixed
     */
    public function delete(int $projectId, int $directoryId)
    {
        $path = sprintf('projects/%d/directories/%d', $projectId, $directoryId);
        return $this->_delete($path);
    }
}
