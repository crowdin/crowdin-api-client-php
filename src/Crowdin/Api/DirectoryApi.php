<?php

namespace Crowdin\Api;

use Crowdin\Model\Directory;

/**
 * Class DirectoryApi
 * @package Crowdin\Api
 */
class DirectoryApi extends AbstractApi
{
    /**
     * @param int $projectId
     * @return mixed
     */
    public function list(int $projectId)
    {
        $path = sprintf('projects/%d/directories', $projectId);
        return $this->_list($path, Directory::class);
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
