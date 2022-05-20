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
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.getMany API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.getMany API Documentation Enterprise
     *
     * @param array $params
     * @internal integer $params[groupId] for enterprise only
     * @internal integer $params[hasManagerAccess] for enterprise only Enum{0,1} (0 -false, 1 true)
     * @internal integer $params[limit]
     * @internal integer $params[offset]
     * @internal integer $params[userId] Get user own projects
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
     * @internal string $data[identifier]
     * @internal string $data[type]
     * @internal string $data[sourceLanguageId] required
     * @internal integer $data[groupId] required
     * @internal integer $data[templateId] required
     * @internal integer $data[groupId]
     * @internal array $data[targetLanguageIds]
     * @internal string $data[visibility]
     * @internal string $data[languageAccessPolicy]
     * @internal string $data[cname]
     * @internal integer $data[vendorId]
     * @internal integer $data[mtEngineId]
     * @internal string $data[description]
     * @internal boolean $data[delayedWorkflowStart]
     * @internal boolean $data[skipUntranslatedStrings]
     * @internal boolean $data[skipUntranslatedFiles]
     * @internal integer $data[exportWithMinApprovalsCount]
     * @internal integer $data[exportApprovedOnly]
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
}
