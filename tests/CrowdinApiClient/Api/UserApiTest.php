<?php

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\User;

class UserApiTest extends AbstractTestApi
{
    public function testGetAuthenticatedUser()
    {
        $this->mockRequestGet('/user', '{
          "data": {
            "id": 1,
            "username": "john_smith",
            "email": "jsmith@example.com",
            "fullName": "John Smith",
            "avatarUrl": "",
            "createdAt": "2019-07-11T07:40:22+00:00",
            "lastSeen": "2019-10-23T11:44:02+00:00",
            "twoFactor": "enabled",
            "timezone": "Europe/Kiev"
          }
        }');

        $user = $this->crowdin->user->getAuthenticatedUser();

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals(1, $user->getId());
    }
}
