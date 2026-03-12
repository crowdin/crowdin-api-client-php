<?php

namespace CrowdinApiClient\Api\Enterprise;

use CrowdinApiClient\Api\AbstractApi;
use CrowdinApiClient\Model\Enterprise\AddedTeamMembers;
use CrowdinApiClient\Model\Enterprise\TeamMember;
use CrowdinApiClient\ModelCollection;

/**
 * Use API to manage team members
 *
 * @package Crowdin\Api\Enterprise
 */
class TeamMemberApi extends AbstractApi
{
    /**
     * Team Members List
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.teams.members.getMany API Documentation
     *
     * @param int $teamId
     * @param array $params
     * @return ModelCollection
     */
    public function list(int $teamId, array $params = []): ModelCollection
    {
        return $this->_list(sprintf('teams/%d/members', $teamId), TeamMember::class, $params);
    }

    /**
     * Add Team Members
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.teams.members.post API Documentation
     *
     * @param int $teamId
     * @param array $data
     * @return AddedTeamMembers
     */
    public function create(int $teamId, array $data): AddedTeamMembers
    {
        return $this->_post(sprintf('teams/%d/members', $teamId), AddedTeamMembers::class, $data);
    }

    /**
     * Delete All Team Members
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.teams.members.deleteMany API Documentation
     *
     * @param int $teamId
     * @return mixed
     */
    public function clear(int $teamId)
    {
        return $this->_delete(sprintf('teams/%d/members', $teamId));
    }

    /**
     * Delete Team member
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.teams.members.delete
     *
     * @param int $teamId
     * @param int $memberId
     * @return mixed
     */
    public function delete(int $teamId, int $memberId)
    {
        return $this->_delete(sprintf('teams/%d/members/%d', $teamId, $memberId));
    }
}
