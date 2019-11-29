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
     * @param array $params
     * @return ModelCollection
     */
    public function list(array $params = []): ModelCollection
    {
        return $this->_list('users', User::class, $params);
    }

    /**
     * @param int $userId
     * @return User|null
     */
    public function get(int $userId): ?User
    {
        return $this->_get('users/' . $userId, User::class);
    }

    /**
     * @return \CrowdinApiClient\Model\User|null
     */
    public function getAuthenticatedUser(): ?User
    {
        return $this->_get('user', User::class);
    }
}
