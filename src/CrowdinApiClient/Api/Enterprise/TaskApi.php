<?php

declare(strict_types=1);

namespace CrowdinApiClient\Api\Enterprise;

use CrowdinApiClient\Api\TaskApi as CrowdinTaskApi;
use CrowdinApiClient\Model\Task;
use CrowdinApiClient\ModelCollection;

/**
 * Create and assign tasks to get files translated or proofread by specific people.
 *
 * @package Crowdin\Api\Enterprise
 */
class TaskApi extends CrowdinTaskApi
{
    /**
     * List Tasks (all organization tasks)
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.tasks.getMany API Documentation
     *
     * @param array $params
     * string $params[orderBy]<br>
     * integer $params[limit] [1 .. 500] Default: 25<br>
     * integer $params[offset] >= 0 Default: 0<br>
     * string $params[status] Enum: "todo" "in_progress" "done" "closed"<br>
     * string $params[type]<br>
     * string $params[projectIds]<br>
     * string $params[groupIds]<br>
     * string $params[assigneeIds]<br>
     * string $params[creatorIds]<br>
     * string $params[targetLanguageIds]<br>
     * string $params[sourceLanguageIds]<br>
     * string $params[createdAtFrom]<br>
     * string $params[createdAtTo]<br>
     * string $params[deadlineFrom]<br>
     * string $params[deadlineTo]
     * @return ModelCollection
     */
    public function listOrganizationTasks(array $params = []): ModelCollection
    {
        return $this->_list('tasks', Task::class, $params);
    }
}
