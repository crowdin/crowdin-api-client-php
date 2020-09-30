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

    public function testList()
    {
        $this->mockRequestGet('/projects/1/members', '{
          "data": [
            {
              "data": {
                "id": 1,
                "username": "john_smith",
                "fullName": "John Smith",
                "role": "translator",
                "permissions": {
                  "uk": "translator",
                  "it": "proofreader",
                  "en": "denied"
                },
                "avatarUrl": "",
                "joinedAt": "2019-07-11T07:40:22+00:00",
                "timezone": "Europe/Kiev"
              }
            }
          ],
          "pagination": [
            {
              "offset": 0,
              "limit": 25
            }
          ]
        }');

        $users = $this->crowdin->user->list(1);
        /** @var User $user */
        $user = $users[0];

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals(1, $user->getId());
    }

    public function testGetUser()
    {
        $this->mockRequestGet('/projects/1/members/1', '{
          "data": {
            "id": 1,
            "username": "john_smith",
            "fullName": "John Smith",
            "role": "translator",
            "permissions": {
              "uk": "translator",
              "it": "proofreader",
              "en": "denied"
            },
            "avatarUrl": "",
            "joinedAt": "2019-07-11T07:40:22+00:00",
            "timezone": "Europe/Kiev"
          }
        }');

        $user = $this->crowdin->user->get(1, 1);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals(1, $user->getId());
    }
}
