<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\DownloadFile;
use CrowdinApiClient\Model\Task;
use CrowdinApiClient\Model\TaskForUpdate;
use CrowdinApiClient\Model\TaskSettingsTemplate;
use CrowdinApiClient\ModelCollection;

/**
 * Create and assign tasks to get files translated or proofread by specific people.
 * You can set the due dates, split words between people, and receive notifications about the changes and updates on tasks.
 * Tasks are project-specific, so you’ll have to create them within a project.
 * Use API to create, modify, and delete specific tasks.
 *
 * @package Crowdin\Api
 */
class TaskApi extends AbstractApi
{
    /**
     * List Tasks
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.tasks.getMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.tasks.getMany API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $params
     * integer $params[limit]  [ 1 .. 500 ] Default: 25<br>
     * integer $params[offset]  >= 0 Default: 0<br>
     * string $params[status]  Enum: "todo" "in_progress" "done" "closed" Example: status=done<br>
     * integer $params[assigneeId]
     *
     * @return ModelCollection
     */
    public function list(int $projectId, array $params = []): ModelCollection
    {
        $path = sprintf('projects/%s/tasks', $projectId);
        return $this->_list($path, Task::class, $params);
    }

    /**
     * Get Task
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.tasks.get API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.tasks.get API Documentation Enterprise
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
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.tasks.post API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.tasks.post API Documentation Enterprise
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
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.tasks.patch API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.tasks.patch API Documentation Enterprise
     *
     * @param TaskForUpdate|Task $task
     * @return Task|null
     */
    public function update($task): ?Task
    {
        $path = sprintf('projects/%d/tasks/%d', $task->getProjectId(), $task->getId());
        return $this->_update($path, $task);
    }

    /**
     * Delete Task
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.tasks.delete API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.tasks.delete API Documentation Enterprise
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
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.tasks.export.get API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.tasks.export.get API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $taskId
     * @return DownloadFile|null
     */
    public function exportStrings(int $projectId, int $taskId): ?DownloadFile
    {
        $path = sprintf('projects/%d/tasks/%d/exports', $projectId, $taskId);
        return $this->_post($path, DownloadFile::class, []);
    }

    /**
     * List User Tasks
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.user.tasks.getMany API Documentation Enterprise
     *
     * @param array $params
     * integer $params[limit]  [ 1 .. 500 ] Default: 25<br>
     * integer $params[offset]  >= 0 Default: 25<br>
     * string $params[status]  Enum: "todo" "in_progress" "done" "closed" Example: status=done<br>
     * string $params[isArchived]  Default: 0 Default: 0 Example: isArchived=1
     *
     * @return ModelCollection
     */
    public function listUserTasks(array $params = []): ?ModelCollection
    {
        return  $this->_list('user/tasks', Task::class, $params);
    }

    /**
     * Edit Task Archived Status
     * @link https://developer.crowdin.com/api/v2/#operation/api.user.tasks.patch API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.user.tasks.patch API Documentation Enterprise
     *
     * @param int $taskId
     * @param int $projectId
     * @param bool $isArchived
     * @return Task|null
     */
    public function userTaskArchivedStatus(int $taskId, int $projectId, bool $isArchived = true): ?Task
    {
        $path = sprintf('user/tasks/%s', $taskId);

        $body = [
            [
                'op' => 'replace',
                'path' => '/isArchived',
                'value' => $isArchived,
            ]
        ];

        return $this->_patch($path, Task::class, $body, ['projectId' => $projectId]);
    }

    /**
     * List Task Settings template
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.tasks.settings-templates.getMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.tasks.settings-templates.getMany API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $params
     * integer $params[limit]  [ 1 .. 500 ] Default: 25<br>
     * integer $params[offset]  >= 0 Default: 0<br>
     *
     * @return ModelCollection
     */
    public function listSettingsTemplates(int $projectId, array $params = []): ModelCollection
    {
        $path = sprintf('projects/%s/tasks/settings-templates', $projectId);
        return $this->_list($path, TaskSettingsTemplate::class, $params);
    }

    /**
     * Get Task Settings template
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.tasks.settings-templates.get API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.tasks.settings-templates.get API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $taskSettingsTemplateId
     * @return TaskSettingsTemplate|null
     */
    public function getSettingsTemplate(int $projectId, int $taskSettingsTemplateId): ?TaskSettingsTemplate
    {
        $path = sprintf('projects/%d/tasks/settings-templates/%d', $projectId, $taskSettingsTemplateId);
        return $this->_get($path, TaskSettingsTemplate::class);
    }

    /**
     * Add Task Settings Template
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.tasks.settings-templates.post API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.tasks.settings-templates.post API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $data
     * string $data[name] required<br>
     * array $data[config] required<br>
     * @return TaskSettingsTemplate|null
     */
    public function addSettingsTemplate(int $projectId, array $data): ?TaskSettingsTemplate
    {
        $path = sprintf('projects/%d/tasks/settings-templates', $projectId);
        return $this->_create($path, TaskSettingsTemplate::class, $data);
    }

    /**
     * Delete Task Settings Template
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.tasks.settings-templates.delete API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.tasks.settings-templates.delete API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $taskSettingsTemplateId
     * @return mixed
     */
    public function deleteSettingsTemplate(int $projectId, int $taskSettingsTemplateId)
    {
        $path = sprintf('projects/%d/tasks/settings-templates/%d', $projectId, $taskSettingsTemplateId);
        return $this->_delete($path);
    }

    /**
     * Update Task Settings Template
     *
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.tasks.settings-templates.patch API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.tasks.settings-templates.patch API Documentation Enterprise
     *
     * @param int $projectId
     * @param TaskSettingsTemplate $taskSettingsTemplate
     * @return TaskSettingsTemplate|null
     */
    public function updateSettingsTemplate(int $projectId, TaskSettingsTemplate $taskSettingsTemplate): ?TaskSettingsTemplate
    {
        $path = sprintf('projects/%d/tasks/settings-templates/%d', $projectId, $taskSettingsTemplate->getId());
        return $this->_update($path, $taskSettingsTemplate);
    }
}
