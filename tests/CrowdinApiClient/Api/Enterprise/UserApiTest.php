<?php

namespace CrowdinApiClient\Tests\Api\Enterprise;

use CrowdinApiClient\Model\Enterprise\User;
use CrowdinApiClient\ModelCollection;

class UserApiTest extends AbstractTestApi
{
    public function testList()
    {
        $this->mockRequest([
            'path' => '/users',
            'method' => 'get',
            'response' => '{
                  "data": [
                    {
                      "data": {
                        "id": 1,
                        "username": "john_smith",
                        "email": "jsmith@example.com",
                        "firstName": "John",
                        "lastName": "Smith",
                        "status": "active",
                        "avatarUrl": "",
                        "createdAt": "2019-07-11T07:40:22+00:00",
                        "lastSeen": "2019-10-23T11:44:02+00:00",
                        "twoFactor": "enabled",
                        "isAdmin": true,
                        "timezone": "Europe/Kiev"
                      }
                    }
                  ],
                  "pagination": [
                    {
                      "offset": 0,
                      "limit": 0
                    }
                  ]
                }'
        ]);

        $users = $this->crowdin->user->list();

        $this->assertInstanceOf(ModelCollection::class, $users);
        $this->assertCount(1, $users);
        $this->assertInstanceOf(User::class, $users[0]);
        $this->assertEquals(1, $users[0]->getId());
    }

    public function testGetUser()
    {
        $this->mockRequestGet('/users/1', '{
              "data": {
                "id": 1,
                "username": "john_smith",
                "email": "jsmith@example.com",
                "firstName": "John",
                "lastName": "Smith",
                "status": "active",
                "avatarUrl": "",
                "createdAt": "2019-07-11T07:40:22+00:00",
                "lastSeen": "2019-10-23T11:44:02+00:00",
                "twoFactor": "enabled",
                "isAdmin": true,
                "timezone": "Europe/Kiev"
              }
            }');

        $user = $this->crowdin->user->get(1);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals(1, $user->getId());
    }

    public function testGetAuthenticatedUser()
    {
        $this->mockRequestGet('/user', '{
              "data": {
                "id": 1,
                "username": "john_smith",
                "email": "jsmith@example.com",
                "firstName": "John",
                "lastName": "Smith",
                "status": "active",
                "avatarUrl": "",
                "createdAt": "2019-07-11T07:40:22+00:00",
                "lastSeen": "2019-10-23T11:44:02+00:00",
                "twoFactor": "enabled",
                "isAdmin": true,
                "timezone": "Europe/Kiev"
              }
            }');

        $user = $this->crowdin->user->getAuthenticatedUser();

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals(1, $user->getId());
    }
}
