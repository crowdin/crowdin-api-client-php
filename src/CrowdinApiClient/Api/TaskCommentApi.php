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
}
