<?php

namespace CrowdinApiClient\Api\Enterprise;

use CrowdinApiClient\Api\AbstractApi;
use CrowdinApiClient\Model\Enterprise\Directory;
use CrowdinApiClient\ModelCollection;

/**
 * Class DirectoryApi
 * @package Crowdin\Api
 */
class DirectoryApi extends AbstractApi
{
    /**
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
     * @param Directory $directory
     * @return Directory|null
     */
    public function update(Directory $directory): ?Directory
    {
        $path = sprintf('projects/%d/directories/%d', $directory->getProjectId(), $directory->getId());
        return $this->_update($path, $directory);
    }

    /**
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
