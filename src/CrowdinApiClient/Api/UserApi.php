<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\User;

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
}
