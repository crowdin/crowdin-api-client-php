<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\TaskComment;
use CrowdinApiClient\ModelCollection;

/**
 * Manage comments on tasks within projects
 *
 * @package Crowdin\Api
 */
class TaskCommentApi extends AbstractApi
{
    /**
     * List Task Comments
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.tasks.comments.getMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.tasks.comments.getMany API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $taskId
     * @param array $params
     * integer $params[limit] Default: 25<br>
     * integer $params[offset] Default: 0<br>
     *
     * @return ModelCollection
     */
    public function list(int $projectId, int $taskId, array $params = []): ModelCollection
    {
        $path = sprintf('projects/%d/tasks/%d/comments', $projectId, $taskId);
        return $this->_list($path, TaskComment::class, $params);
    }

    /**
     * Get Task Comment
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.tasks.comments.get API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.tasks.comments.get API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $taskId
     * @param int $commentId
     * @return TaskComment|null
     */
    public function get(int $projectId, int $taskId, int $commentId): ?TaskComment
    {
        $path = sprintf('projects/%d/tasks/%d/comments/%d', $projectId, $taskId, $commentId);
        return $this->_get($path, TaskComment::class);
    }

    /**
     * Add Task Comment
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.tasks.comments.post API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.tasks.comments.post API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $taskId
     * @param array $data
     * string $data[text] Text comment<br>
     * integer $data[timeSpent] Time spent on the task in seconds<br>
     *
     * @return TaskComment|null
     */
    public function create(int $projectId, int $taskId, array $data): ?TaskComment
    {
        $path = sprintf('projects/%d/tasks/%d/comments', $projectId, $taskId);
        return $this->_create($path, TaskComment::class, $data);
    }

    /**
     * Edit Task Comment
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.tasks.comments.patch API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.tasks.comments.patch API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $taskId
     * @param TaskComment $taskComment
     * @return TaskComment|null
     */
    public function update(int $projectId, int $taskId, TaskComment $taskComment): ?TaskComment
    {
        $path = sprintf('projects/%d/tasks/%d/comments/%d', $projectId, $taskId, $taskComment->getId());
        return $this->_update($path, $taskComment);
    }
}
