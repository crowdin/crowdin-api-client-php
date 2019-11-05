<?php

namespace Crowdin\Api;

use Crowdin\Model\Task;

/**
 * Class TaskApi
 * @package Crowdin\Api
 */
class TaskApi extends AbstractApi
{
    public function list(int $projectId)
    {
        $path = sprintf('projects/%s/tasks', $projectId);
        return $this->_list($path, Task::class);
    }

    /**
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
     * @param int $projectId
     * @param array $data
     * @return Task|null
     */
    public function create(int $projectId, array $data):?Task
    {
        $path = sprintf('projects/%d/tasks', $projectId);
        return $this->_create($path, Task::class, $data);
    }

    /**
     * @param Task $task
     * @return Task|null
     */
    public function update(Task $task): ?Task
    {
        $path = sprintf('projects/%d/tasks', $task->getProjectId());
        return $this->_update($path, $task);
    }

    /**
     * @param int $projectId
     * @param int $taskId
     * @return mixed
     */
    public function delete(int $projectId, int $taskId)
    {
        $path = sprintf('projects/%d/tasks/%d', $projectId, $taskId);
        return $this->_delete($path);
    }
}
