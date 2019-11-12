<?php

namespace Crowdin\Api;

use Crowdin\Model\Project;
use Crowdin\Model\ProjectSetting;

/**
 * Class ProjectApi
 * @package Crowdin\Api
 */
class ProjectApi extends AbstractApi
{

    /**
     * @param array $params
     * @return mixed
     */
    public function list(array $params = [])
    {
        return $this->_list('projects', Project::class, $params);
    }

    /**
     * @param int $projectId
     * @return Project|null
     */
    public function get(int $projectId): ?Project
    {
        return $this->_get('projects/' . $projectId, Project::class);
    }

    /**
     * @param array $data
     * @return Project|null
     */
    public function create(array $data): ?Project
    {
        return $this->_create('projects', Project::class, $data);
    }

    /**
     * @param Project $project
     * @return mixed
     */
    public function update(Project $project): ?Project
    {
        return $this->_update('projects/' . $project->getId(), $project);
    }

    /**
     * @param int $projectId
     * @return mixed
     */
    public function delete(int $projectId)
    {
        return $this->client->apiRequest('delete', 'projects/' . $projectId);
    }

    /**
     * @param int $projectId
     * @return ProjectSetting|null
     */
    public function getSettings(int $projectId): ?ProjectSetting
    {
        $path = sprintf('projects/%d/settings', $projectId);
        return $this->_get($path, ProjectSetting::class);
    }

    /**
     * @param ProjectSetting $projectSetting
     * @return ProjectSetting|null
     */
    public function updateSettings(ProjectSetting $projectSetting): ?ProjectSetting
    {
        $path = sprintf('projects/%d/settings/', $projectSetting->getProjectId());

        return $this->_update($path, $projectSetting);
    }
}
