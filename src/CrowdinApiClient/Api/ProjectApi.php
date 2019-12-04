<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\Project;
use CrowdinApiClient\Model\ProjectSetting;
use CrowdinApiClient\ModelCollection;

/**
 * Class ProjectApi
 * @package Crowdin\Api
 */
class ProjectApi extends AbstractApi
{

    /**
     * List Projects
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.getMany API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.getMany API Documentation Enterprise
     *
     * @param array $params
     * @return ModelCollection
     */
    public function list(array $params = []): ModelCollection
    {
        return $this->_list('projects', Project::class, $params);
    }

    /**
     * Get Project Info
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.get API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.get API Documentation Enterprise
     *
     * @param int $projectId
     * @return Project|null
     */
    public function get(int $projectId): ?Project
    {
        return $this->_get('projects/' . $projectId, Project::class);
    }

    /**
     * Add Project
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.post API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.post API Documentation Enterprise
     *
     * @param array $data
     * @internal string $data[name] required
     * @internal string $data[sourceLanguageId] required
     * @internal integer $data[groupId] required
     * @internal integer $data[templateId] required
     * @internal array $data[targetLanguageIds]
     * @internal integer $data[vendorId]
     * @internal integer $data[mtEngineId]
     * @internal string $data[description]
     * @return Project|null
     */
    public function create(array $data): ?Project
    {
        return $this->_create('projects', Project::class, $data);
    }

    /**
     * Edit Project Info
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.patch API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.patch API Documentation Enterprise
     *
     * @param Project $project
     * @return mixed
     */
    public function update(Project $project): ?Project
    {
        return $this->_update('projects/' . $project->getId(), $project);
    }

    /**
     * Delete Project
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.delete API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.delete API Documentation Enterprise
     *
     * @param int $projectId
     * @return mixed
     */
    public function delete(int $projectId)
    {
        return $this->client->apiRequest('delete', 'projects/' . $projectId);
    }

    /**
     * Get Project Settings
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.settings.get API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.settings.get API Documentation Enterprise
     *
     * @param int $projectId
     * @return ProjectSetting|null
     */
    public function getSettings(int $projectId): ?ProjectSetting
    {
        $path = sprintf('projects/%d/settings', $projectId);
        return $this->_get($path, ProjectSetting::class);
    }

    /**
     * Edit Project Settings
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.settings.patch  API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.settings.patch  API Documentation Enterprise
     *
     * @param ProjectSetting $projectSetting
     * @return ProjectSetting|null
     */
    public function updateSettings(ProjectSetting $projectSetting): ?ProjectSetting
    {
        $path = sprintf('projects/%d/settings', $projectSetting->getProjectId());

        return $this->_update($path, $projectSetting);
    }
}
