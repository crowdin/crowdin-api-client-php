<?php

namespace CrowdinApiClient\Api\Enterprise;

use CrowdinApiClient\Api\AbstractApi;
use CrowdinApiClient\Http\ResponseDecorator\ResponseModelListDecorator;
use CrowdinApiClient\Model\Enterprise\Group;
use CrowdinApiClient\Model\Enterprise\GroupManager;
use CrowdinApiClient\Model\Enterprise\GroupTeam;
use CrowdinApiClient\Model\Report;
use CrowdinApiClient\ModelCollection;

/**
 * Groups allow you to organize your projects based on specific characteristics
 *
 * @package Crowdin\Api\Enterprise
 */
class GroupApi extends AbstractApi
{
    /**
     * List Groups
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.groups.getMany API Documentation
     *
     * @param array $params
     * integer $params[parentId]<br>
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function list(array $params = []): ModelCollection
    {
        return $this->_list('groups', Group::class, $params);
    }

    /**
     * Get Group Info
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.groups.get API Documentation
     *
     * @param int $groupID
     * @return Group|null
     */
    public function get(int $groupID): ?Group
    {
        return $this->_get('groups/' . $groupID, Group::class);
    }

    /**
     * Add Group
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.groups.post API Documentation
     *
     * @param array $data
     * @return Group|null
     * string $data[name] required<br>
     * integer $data[parentId]<br>
     * string $data[description]
     */
    public function create(array $data): ?Group
    {
        return $this->_create('groups', Group::class, $data);
    }

    /**
     * Edit Group
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.groups.patch API Documentation
     *
     * @param Group $group
     * @return Group|mixed
     */
    public function update(Group $group): Group
    {
        return $this->_update('groups/' . $group->getId(), $group);
    }

    /**
     * Delete Group
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.groups.delete API Documentation
     *
     * @param int $groupID
     * @return mixed
     */
    public function delete(int $groupID)
    {
        return $this->_delete('groups/' . $groupID);
    }

    /**
     * Generate Group Report
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.groups.reports.post API Documentation
     *
     * @param int $groupID
     * @param array $data
     * string $data[name]<br>
     * array $data[schema]
     * @return Report|null
     */
    public function report(int $groupID, array $data): ?Report
    {
        $path = sprintf('groups/%d/reports', $groupID);

        return $this->_post($path, Report::class, $data);
    }

    /**
     * List Group Managers
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.groups.managers.getMany API Documentation
     *
     * @param int $groupId
     * @param array $params
     * integer $params[teamIds]<br>
     * integer $params[limit]<br>
     * integer $params[offset]<br>
     * string $params[orderBy]
     * @return ModelCollection
     */
    public function listManagers(int $groupId, array $params = []): ModelCollection
    {
        return $this->_list(sprintf('groups/%d/managers', $groupId), GroupManager::class, $params);
    }

    /**
     * Add or Remove Group Managers
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.groups.managers.patch API Documentation
     *
     * @param int $groupId
     * @param array $data JSON Patch array with operations (add, remove)
     * @return ModelCollection
     */
    public function updateManagers(int $groupId, array $data): ModelCollection
    {
        return $this->client->apiRequest(
            'patch',
            sprintf('groups/%d/managers', $groupId),
            new ResponseModelListDecorator(GroupManager::class),
            [
                'body' => json_encode($data),
                'headers' => $this->getHeaders(),
            ]
        );
    }

    /**
     * Get Group Manager
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.groups.managers.get API Documentation
     *
     * @param int $groupId
     * @param int $userId
     * @return GroupManager|null
     */
    public function getManager(int $groupId, int $userId): ?GroupManager
    {
        return $this->_get(sprintf('groups/%d/managers/%d', $groupId, $userId), GroupManager::class);
    }

    /**
     * List Group Teams
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.groups.teams.getMany API Documentation
     *
     * @param int $groupId
     * @param array $params
     * integer $params[limit]<br>
     * integer $params[offset]<br>
     * string $params[orderBy]
     * @return ModelCollection
     */
    public function listTeams(int $groupId, array $params = []): ModelCollection
    {
        return $this->_list(sprintf('groups/%d/teams', $groupId), GroupTeam::class, $params);
    }

    /**
     * Add or Remove Group Teams
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.groups.teams.patch API Documentation
     *
     * @param int $groupId
     * @param array $data JSON Patch array with operations (add, remove)
     * @return ModelCollection
     */
    public function updateTeams(int $groupId, array $data): ModelCollection
    {
        return $this->client->apiRequest(
            'patch',
            sprintf('groups/%d/teams', $groupId),
            new ResponseModelListDecorator(GroupTeam::class),
            [
                'body' => json_encode($data),
                'headers' => $this->getHeaders(),
            ]
        );
    }

    /**
     * Get Group Team
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.groups.teams.get API Documentation
     *
     * @param int $groupId
     * @param int $teamId
     * @return GroupTeam|null
     */
    public function getTeam(int $groupId, int $teamId): ?GroupTeam
    {
        return $this->_get(sprintf('groups/%d/teams/%d', $groupId, $teamId), GroupTeam::class);
    }
}
