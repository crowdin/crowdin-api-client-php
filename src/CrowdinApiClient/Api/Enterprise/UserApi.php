<?php

namespace CrowdinApiClient\Api\Enterprise;

use CrowdinApiClient\Api\AbstractApi;
use CrowdinApiClient\Http\ResponseDecorator\ResponseModelListDecorator;
use CrowdinApiClient\Model\Enterprise\ProjectContribution;
use CrowdinApiClient\Model\Enterprise\ProjectPermission;
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
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.members.post API Documentation
     *
     * @param int $projectId
     * @param array $data
     * @return ProjectTeamMemberAddedStatistics|null
     */
    public function addProjectTeamMember(int $projectId, array $data): ?ProjectTeamMemberAddedStatistics
    {
        return $this->_post(sprintf('projects/%d/members', $projectId), ProjectTeamMemberAddedStatistics::class, $data);
    }

    /**
     * List Project Members
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.members.getMany API Documentation
     *
     * @param int $projectId
     * @param array $data
     * @return ModelCollection
     */
    public function listProjectMembers(int $projectId, array $data = []): ModelCollection
    {
        return $this->_list(sprintf('projects/%d/members', $projectId), ProjectTeamMemberResource::class, $data);
    }

    /**
     * Get Project Member Permissions
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.members.get API Documentation
     *
     * @param int $projectId
     * @param int $memberId
     * @return ProjectTeamMemberResource|null
     */
    public function getProjectMemberPermissions(int $projectId, int $memberId): ?ProjectTeamMemberResource
    {
        return $this->_get(sprintf('projects/%d/members/%d', $projectId, $memberId), ProjectTeamMemberResource::class);
    }

    /**
     * Replace Project Member Permissions
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.members.put API Documentation
     *
     * @param int $projectId
     * @param int $memberId
     * @param array $data
     * @return ProjectTeamMemberResource|null
     */
    public function replaceProjectMemberPermissions(
        int $projectId,
        int $memberId,
        array $data
    ): ?ProjectTeamMemberResource {
        return $this->_put(
            sprintf('projects/%d/members/%d', $projectId, $memberId),
            ProjectTeamMemberResource::class,
            $data
        );
    }

    /**
     * Delete Member From Project
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.members.delete API Documentation
     *
     * @param int $projectId
     * @param int $memberId
     */
    public function deleteMemberFromProject(int $projectId, int $memberId): void
    {
        $this->_delete(sprintf('projects/%d/members/%s', $projectId, $memberId));
    }

    /**
     * List Users
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.users.getMany API Documentation
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
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.users.getById API Documentation
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
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.user.get API Documentation
     *
     * @return User|null
     */
    public function getAuthenticatedUser(): ?User
    {
        return $this->_get('user', User::class);
    }

    /**
     * Invite User
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.users.post API Documentation
     *
     * @param array $data
     * @return User|null
     */
    public function invite(array $data): ?User
    {
        return $this->_post('users', User::class, $data);
    }

    /**
     * Delete User
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.users.delete API Documentation
     *
     * @param int $userId
     * @return mixed
     */
    public function delete(int $userId)
    {
        return $this->_delete('users/' . $userId);
    }

    /**
     * Update User
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.users.patch API Documentation
     *
     * @param User $user
     * @return User|null
     */
    public function update(User $user): ?User
    {
        return $this->_update('users/' . $user->getId(), $user);
    }

    /**
     * List User Projects Permissions
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.users.projects.permissions.getMany API Documentation
     *
     * @param int $userId
     * @param array $params
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function listProjectPermissions(int $userId, array $params = []): ModelCollection
    {
        return $this->_list(sprintf('users/%d/projects/permissions', $userId), ProjectPermission::class, $params);
    }

    /**
     * Permissions Batch Operations
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.users.projects.permissions.patch API Documentation
     *
     * @param int $userId
     * @param array $data JSON Patch array. op: add, replace or remove, path: /{projectId}/roles<br>
     * value: list of role name and permissions
     * @return ModelCollection
     */
    public function updateProjectPermissions(int $userId, array $data): ModelCollection
    {
        return $this->client->apiRequest(
            'patch',
            sprintf('users/%d/projects/permissions', $userId),
            new ResponseModelListDecorator(ProjectPermission::class),
            [
                'body' => json_encode($data),
                'headers' => $this->getHeaders(),
            ]
        );
    }

    /**
     * List User Projects Contributions
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.users.projects.contributions.getMany API Documentation
     *
     * @param int $userId
     * @param array $params
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function listProjectContributions(int $userId, array $params = []): ModelCollection
    {
        return $this->_list(
            sprintf('users/%d/projects/contributions', $userId),
            ProjectContribution::class,
            $params
        );
    }
}
