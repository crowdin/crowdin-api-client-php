<?php

namespace CrowdinApiClient\Api\Enterprise;

use CrowdinApiClient\Api\AbstractApi;
use CrowdinApiClient\Model\Enterprise\Project;
use CrowdinApiClient\Model\Enterprise\ProjectSetting;
use CrowdinApiClient\ModelCollection;

/**
 * Class ProjectApi
 * @package Crowdin\Api
 */
class ProjectApi extends AbstractApi
{

    /**
     * @param array $params
     * @return ModelCollection
     */
    public function list(array $params = []): ModelCollection
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
        $path = sprintf('projects/%d/settings', $projectSetting->getProjectId());

        return $this->_update($path, $projectSetting);
    }
}
