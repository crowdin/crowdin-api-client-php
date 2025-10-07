<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\Project;
use CrowdinApiClient\ModelCollection;

/**
 * Using projects, you can keep your source files sorted.
 * Use API to manage projects, change their settings, or remove them if required.
 *
 * @package Crowdin\Api
 */
class ProjectApi extends AbstractApi
{

    /**
     * List Projects
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.getMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.getMany API Documentation Enterprise
     *
     * @param array $params
     * integer $params[groupId] for enterprise only<br>
     * integer $params[hasManagerAccess] for enterprise only Enum{0,1} (0 -false, 1 true)<br>
     * integer $params[limit]<br>
     * integer $params[offset]<br>
     * integer $params[userId] Get user own projects
     * @return ModelCollection
     */
    public function list(array $params = []): ModelCollection
    {
        return $this->_list('projects', Project::class, $params);
    }

    /**
     * Get Project Info
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.get API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.get API Documentation Enterprise
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
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.post API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.post API Documentation Enterprise
     *
     * @param array $data
     * string $data[name] required<br>
     * string $data[identifier]<br>
     * string $data[type]<br>
     * string $data[sourceLanguageId] required<br>
     * integer $data[groupId] required<br>
     * integer $data[templateId] required<br>
     * integer $data[groupId]<br>
     * array $data[targetLanguageIds]<br>
     * string $data[visibility]<br>
     * string $data[languageAccessPolicy]<br>
     * string $data[cname]<br>
     * integer $data[vendorId]<br>
     * integer $data[mtEngineId]<br>
     * string $data[description]<br>
     * boolean $data[delayedWorkflowStart]<br>
     * boolean $data[skipUntranslatedStrings]<br>
     * boolean $data[skipUntranslatedFiles]<br>
     * integer $data[exportWithMinApprovalsCount]<br>
     * integer $data[exportApprovedOnly]<br>
     * integer $data[defaultTmId]<br>
     * integer $data[defaultGlossaryId]
     * @return Project|null
     */
    public function create(array $data): ?Project
    {
        return $this->_create('projects', Project::class, $data);
    }

    /**
     * Edit Project Info
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.patch API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.patch API Documentation Enterprise
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
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.delete API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.delete API Documentation Enterprise
     *
     * @param int $projectId
     * @return mixed
     */
    public function delete(int $projectId)
    {
        return $this->client->apiRequest('delete', 'projects/' . $projectId);
    }
}
