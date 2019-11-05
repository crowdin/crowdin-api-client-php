<?php

namespace Crowdin\Api;

use Crowdin\Model\User;

/**
 * Class UserApi
 * @package Crowdin\Api
 */
class UserApi extends AbstractApi
{
    /**
     * @return mixed
     */
    public function list()
    {
        return $this->_list('users', User::class);
    }

    /**
     * @param int $userId
     * @return User|null
     */
    public function get(int $userId): ?User
    {
        return $this->_get('user/' . $userId, User::class);
    }
}
