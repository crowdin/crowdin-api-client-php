<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\Directory;
use CrowdinApiClient\ModelCollection;

/**
 * Manage project directories to keep files structure
 *
 * @package Crowdin\Api
 */
class DirectoryApi extends AbstractApi
{
    /**
     * List Directories
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.directories.getMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.directories.getMany API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $params
     * integer $params[branchId]<br>
     * integer $params[directoryId]<br>
     * integer $params[recursion]<br>
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function list(int $projectId, array $params = []): ModelCollection
    {
        $path = sprintf('projects/%d/directories', $projectId);
        return $this->_list($path, Directory::class, $params);
    }

    /**
     * Get Directory Info
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.directories.get  API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.directories.get  API Documentation Enterprise
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
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.directories.post API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.directories.post API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $data
     * string $data[name] required<br>
     * integer $data[branchId]<br>
     * integer $data[directoryId]<br>
     * string $data[title]<br>
     * string $data[exportPattern]<br>
     * string $data[priority] Enum: "low" "normal" "high"
     * @return Directory|null
     */
    public function create(int $projectId, array $data): ?Directory
    {
        $path = sprintf('projects/%d/directories', $projectId);
        return $this->_create($path, Directory::class, $data);
    }

    /**
     * Edit Directory
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.directories.patch  API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.directories.patch  API Documentation Enterprise
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
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.directories.delete  API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.directories.delete  API Documentation Enterprise
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
