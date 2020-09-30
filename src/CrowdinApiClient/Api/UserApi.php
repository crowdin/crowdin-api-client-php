<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\User;
use CrowdinApiClient\ModelCollection;

/**
 * Class UserApi
 * @package Crowdin\Api
 */
class UserApi extends AbstractApi
{
    /**
     * Get Authenticated User
     * @link https://support.crowdin.com/api/v2/#operation/api.user.get API Documentation
     *
     * @return User|null
     */
    public function getAuthenticatedUser(): ?User
    {
        return $this->_get('user', User::class);
    }

    /**
     * List Project Members
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.members.getMany API Documentation
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
     * Get Member Info
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.members.get API Documentation
     *
     * @param int $projectId
     * @param int $memberId
     * @return User
     */
    public function get(int $projectId, int $memberId): User
    {
        return $this->_get(sprintf('projects/%d/members/%d', $projectId, $memberId), User::class);
    }
}
