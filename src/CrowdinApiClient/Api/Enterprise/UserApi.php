<?php

namespace CrowdinApiClient\Api\Enterprise;

use CrowdinApiClient\Api\AbstractApi;
use CrowdinApiClient\Model\Enterprise\ProjectTeamMemberAddedStatistics;
use CrowdinApiClient\Model\Enterprise\ProjectTeamMemberResource;
use CrowdinApiClient\Model\Enterprise\User;
use CrowdinApiClient\ModelCollection;

/**
 * Users are the members of your organization with the defined access levels (e.g. manager, admin, contributor).
 * Use API to get the list of organization users and to check the information on a specific user.
 *
 * @package Crowdin\Api\Enterprise
 */
class UserApi extends AbstractApi
{
    /**
     * Add Project Member
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.members.post API Documentation
     *
     * @param int $projectId
     * @param array $data
     * @return ProjectTeamMemberAddedStatistics
     */
    public function addProjectTeamMember(int $projectId, array $data): ProjectTeamMemberAddedStatistics
    {
        return $this->_post(sprintf('projects/%d/members', $projectId), ProjectTeamMemberAddedStatistics::class, $data);
    }

    /**
     * List Project Members
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.members.getMany API Documentation
     *
     * @param int $projectId
     * @param array $data
     * @return ModelCollection
     */
    public function listProjectMembers(int $projectId, array $data): ModelCollection
    {
        return $this->_list(sprintf('projects/%d/members', $projectId), ProjectTeamMemberResource::class, $data);
    }

    /**
     * Get Project Member Permissions
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.members.post API Documentation
     *
     * @param int $projectId
     * @param int $memberId
     * @return ProjectTeamMemberResource
     */
    public function getProjectMemberPermissions(int $projectId, int $memberId): ProjectTeamMemberResource
    {
        return $this->_get(sprintf('projects/%d/members/%d', $projectId, $memberId), ProjectTeamMemberResource::class);
    }

    /**
     * Replace Project Member Permissions
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.members.put API Documentation
     *
     * @param int $projectId
     * @param int $memberId
     * @param array $data
     * @return ProjectTeamMemberResource
     */
    public function replaceProjectMemberPermissions(int $projectId, int $memberId, array $data): ProjectTeamMemberResource
    {
        return $this->_put(sprintf('projects/%d/members/%d', $projectId, $memberId), ProjectTeamMemberResource::class, $data);
    }

    /**
     * Delete Member From Project
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.members.delete API Documentation
     *
     * @param int $projectId
     * @param int $memberId
     */
    public function deleteMemberFromProject(int $projectId, int $memberId): void
    {
        $path = sprintf('projects/%d/members/%s', $projectId, $memberId);
        $this->_delete($path);
    }

    /**
     * List Users
     * @link https://support.crowdin.com/enterprise/api/#operation/api.users.getMany API Documentation
     *
     * @param array $params
     * @return ModelCollection
     */
    public function list(array $params = []): ModelCollection
    {
        return $this->_list('users', User::class, $params);
    }

    /**
     * Get User Info
     * @link https://support.crowdin.com/enterprise/api/#operation/api.users.getById API Documentation
     *
     * @param int $userId
     * @return User|null
     */
    public function get(int $userId): ?User
    {
        return $this->_get('users/' . $userId, User::class);
    }

    /**
     * Get Authenticated User
     * @link https://support.crowdin.com/enterprise/api/#operation/api.user.get API Documentation
     *
     * @return \CrowdinApiClient\Model\User|null
     */
    public function getAuthenticatedUser(): ?User
    {
        return $this->_get('user', User::class);
    }

    /**
     * Invite User
     * @link https://support.crowdin.com/enterprise/api/#operation/api.users.post API Documentation
     *
     * @param array $data
     * @return User
     */
    public function invite(array $data): User
    {
        return $this->_post('users', User::class, $data);
    }
}
