<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\DownloadFile;
use CrowdinApiClient\Model\Task;
use CrowdinApiClient\ModelCollection;

/**
 * Class TaskApi
 * @package Crowdin\Api
 */
class TaskApi extends AbstractApi
{
    /**
     * List Tasks
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.tasks.getMany API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.tasks.getMany API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $params
     * @return ModelCollection
     */
    public function list(int $projectId, array $params = []): ModelCollection
    {
        $path = sprintf('projects/%s/tasks', $projectId);
        return $this->_list($path, Task::class, $params);
    }

    /**
     * Get Task
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.tasks.get API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.tasks.get API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $taskId
     * @return Task|null
     */
    public function get(int $projectId, int $taskId): ?Task
    {
        $path = sprintf('projects/%d/tasks/%d', $projectId, $taskId);
        return $this->_get($path, Task::class);
    }

    /**
     * Add Task
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.tasks.post API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.tasks.post API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $data
     * @return Task|null
     */
    public function create(int $projectId, array $data): ?Task
    {
        $path = sprintf('projects/%d/tasks', $projectId);
        return $this->_create($path, Task::class, $data);
    }

    /**
     * Edit Task
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.tasks.patch API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.tasks.patch API Documentation Enterprise
     *
     * @param Task $task
     * @return Task|null
     */
    public function update(Task $task): ?Task
    {
        $path = sprintf('projects/%d/tasks/%d', $task->getProjectId(), $task->getId());
        return $this->_update($path, $task);
    }

    /**
     * Delete Task
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.tasks.delete API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.tasks.delete API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $taskId
     * @return mixed
     */
    public function delete(int $projectId, int $taskId)
    {
        $path = sprintf('projects/%d/tasks/%d', $projectId, $taskId);
        return $this->_delete($path);
    }

    /**
     * Export Task Strings
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.tasks.export.get API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.tasks.export.get API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $taskId
     * @return DownloadFile|null
     */
    public function exportStrings(int $projectId, int $taskId): ?DownloadFile
    {
        $path = sprintf('projects/%d/tasks/%d/export', $projectId, $taskId);
        return $this->_get($path, DownloadFile::class);
    }
}
