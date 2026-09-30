<?php

namespace CrowdinApiClient\Api\Enterprise;

use CrowdinApiClient\Api\AbstractApi;
use CrowdinApiClient\Http\ResponseDecorator\ResponseModelListDecorator;
use CrowdinApiClient\Model\Enterprise\AddedProjectTeamInfo;
use CrowdinApiClient\Model\Enterprise\ProjectPermission;
use CrowdinApiClient\Model\Enterprise\Team;
use CrowdinApiClient\ModelCollection;

/**
 * Use API to manage organization teams
 *
 * @package Crowdin\Api\Enterprise
 */
class TeamApi extends AbstractApi
{
    /**
     * Add Team ToProject
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.teams.post API Documentation
     *
     * @param int $projectId
     * @param array $data
     * integer $data[teamId] required<br>
     * boolean $data[accessToAllWorkflowSteps] Deprecated, use roles instead<br>
     * boolean $data[managerAccess]<br>
     * array $data[permissions] Deprecated, use roles instead<br>
     * array $data[roles]
     * @return AddedProjectTeamInfo
     */
    public function addTeamToProject(int $projectId, array $data): AddedProjectTeamInfo
    {
        $path = sprintf('projects/%d/teams', $projectId);
        return $this->_post($path, AddedProjectTeamInfo::class, $data);
    }

    /**
     * List Teams
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.teams.getMany API Documentation
     *
     * @param array $params
     * @return ModelCollection
     */
    public function list(array $params = []): ModelCollection
    {
        return $this->_list('teams', Team::class, $params);
    }

    /**
     * Add Team
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.teams.post API Documentation
     *
     * @param array $data
     * string $data[name]
     * @return Team
     */
    public function create(array $data): Team
    {
        return $this->_post('teams', Team::class, $data);
    }

    /**
     * Get Team
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.teams.get
     *
     * @param int $teamId
     * @return Team
     */
    public function get(int $teamId): Team
    {
        return $this->_get('teams/' . $teamId, Team::class);
    }

    /**
     * Delete Team
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.teams.delete API Documentation
     *
     * @param int $teamId
     * @return mixed
     */
    public function delete(int $teamId)
    {
        return $this->_delete('teams/' . $teamId);
    }

    /**
     * Edit Team
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.teams.patch API Documentation
     *
     * @param Team $team
     * @return Team
     */
    public function update(Team $team): Team
    {
        return $this->_update('teams/' . $team->getId(), $team);
    }

    /**
     * List Team Projects Permissions
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.teams.projects.permissions.getMany API Documentation
     *
     * @param int $teamId
     * @param array $params
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function listProjectPermissions(int $teamId, array $params = []): ModelCollection
    {
        return $this->_list(sprintf('teams/%d/projects/permissions', $teamId), ProjectPermission::class, $params);
    }

    /**
     * Permissions Batch Operations
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.teams.projects.permissions.patch API Documentation
     *
     * @param int $teamId
     * @param array $data JSON Patch array. op: add, replace or remove, path: /{projectId}/roles<br>
     * value: list of role name and permissions
     * @return ModelCollection
     */
    public function updateProjectPermissions(int $teamId, array $data): ModelCollection
    {
        return $this->client->apiRequest(
            'patch',
            sprintf('teams/%d/projects/permissions', $teamId),
            new ResponseModelListDecorator(ProjectPermission::class),
            [
                'body' => json_encode($data),
                'headers' => $this->getHeaders(),
            ]
        );
    }
}
