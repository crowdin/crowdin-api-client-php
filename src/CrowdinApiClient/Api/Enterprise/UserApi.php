<?php

namespace CrowdinApiClient\Api\Enterprise;

use CrowdinApiClient\Api\AbstractApi;
use CrowdinApiClient\Model\Enterprise\User;
use CrowdinApiClient\ModelCollection;

/**
 * Class UserApi
 * @package Crowdin\Api
 */
class UserApi extends AbstractApi
{
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
}
