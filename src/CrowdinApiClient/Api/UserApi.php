<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\ProjectMember;
use CrowdinApiClient\Model\ProjectMemberAddedStatistics;
use CrowdinApiClient\Model\User;
use CrowdinApiClient\ModelCollection;

/**
 * Users API gives you the possibility to get profile information about the currently authenticated user.
 *
 * @package Crowdin\Api
 */
class UserApi extends AbstractApi
{
    /**
     * Get Authenticated User
     * @link https://developer.crowdin.com/api/v2/#operation/api.user.get API Documentation
     *
     * @return User|null
     */
    public function getAuthenticatedUser(): ?User
    {
        return $this->_get('user', User::class);
    }

    /**
     * Update Authenticated User
     * @link https://developer.crowdin.com/api/v2/#operation/api.user.patch API Documentation
     *
     * @param User $user
     * @return User|null
     */
    public function updateAuthenticatedUser(User $user): ?User
    {
        return $this->_update('user', $user);
    }

    /**
     * @deprecated This method returns wrong model. Use listProjectMembers method instead.
     *
     * List Project Members
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.members.getMany API Documentation
     *
     * @param int $projectId
     * @param array $params
     * @return ModelCollection
     */
    public function list(int $projectId, array $params = []): ModelCollection
    {
        return $this->_list(sprintf('projects/%d/members', $projectId), User::class, $params);
    }

    /**
     * @deprecated This method returns wrong model. Use getProjectMemberInfo method instead.
     *
     * Get Member Info
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.members.get API Documentation
     *
     * @param int $projectId
     * @param int $memberId
     * @return User
     */
    public function get(int $projectId, int $memberId): User
    {
        return $this->_get(sprintf('projects/%d/members/%d', $projectId, $memberId), User::class);
    }

    /**
     * List Project Members
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.members.getMany API Documentation
     *
     * @param int $projectId
     * @param array $params
     * @return ModelCollection
     */
    public function listProjectMembers(int $projectId, array $params = []): ModelCollection
    {
        return $this->_list(sprintf('projects/%d/members', $projectId), ProjectMember::class, $params);
    }

    /**
     * Add Project Member
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.members.post API Documentation
     *
     * @param int $projectId
     * @param array $data
     * @return ProjectMemberAddedStatistics
     */
    public function addProjectMember(int $projectId, array $data): ProjectMemberAddedStatistics
    {
        return $this->_post(sprintf('projects/%d/members', $projectId), ProjectMemberAddedStatistics::class, $data);
    }

    /**
     * Get Member Info
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.members.get API Documentation
     *
     * @param int $projectId
     * @param int $memberId
     * @return ProjectMember|null
     */
    public function getProjectMemberInfo(int $projectId, int $memberId): ?ProjectMember
    {
        return $this->_get(sprintf('projects/%d/members/%d', $projectId, $memberId), ProjectMember::class);
    }

    /**
     * Replace Project Member Permissions
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.members.put API Documentation
     *
     * @param int $projectId
     * @param int $memberId
     * @param array $data
     * @return ProjectMember|null
     */
    public function replaceProjectMemberPermissions(
        int $projectId,
        int $memberId,
        array $data
    ): ?ProjectMember {
        return $this->_put(
            sprintf('projects/%d/members/%d', $projectId, $memberId),
            ProjectMember::class,
            $data
        );
    }

    /**
     * Delete Member From Project
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.members.delete API Documentation
     *
     * @param int $projectId
     * @param int $memberId
     */
    public function deleteMemberFromProject(int $projectId, int $memberId): void
    {
        $this->_delete(sprintf('projects/%d/members/%s', $projectId, $memberId));
    }
}
