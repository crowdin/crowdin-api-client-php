<?php

declare(strict_types=1);

namespace CrowdinApiClient\Api\Enterprise;


use CrowdinApiClient\Model\Enterprise\TeamMember;
use CrowdinApiClient\ModelCollection;
use CrowdinApiClient\Tests\Api\Enterprise\AbstractTestApi;

class TeamMemberApiTest extends AbstractTestApi
{
    public function testList()
    {
        $this->mockRequest([
            'path' => '/teams/2/members',
            'method' => 'get',
            'response' => '{
                  "data": [
                    {
                      "data": {
                        "id": 2,
                        "username": "john.doe",
                        "firstName": "John",
                        "lastName": "Doe",
                        "avatarUrl": "",
                        "addedAt": "2019-09-23T09:04:29+00:00"
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

        $teamMember = $this->crowdin->teamMember->list(2);
        $this->assertInstanceOf(ModelCollection::class, $teamMember);
        $this->assertCount(1, $teamMember);
        $this->assertInstanceOf(TeamMember::class, $teamMember[0]);
        $this->assertEquals(2, $teamMember[0]->getId());
        $this->assertEquals('John', $teamMember[0]->getFirstName());
    }

    public function testCreate()
    {
        $params = [
            'userIds' => [2],
        ];

        $this->mockRequest([
            'path' => '/teams/2/members',
            'method' => 'post',
            'response' => '{
                  "skipped": [
                    {
                      "data": {
                        "id": 2,
                        "username": "john.doe",
                        "firstName": "John",
                        "lastName": "Doe",
                        "avatarUrl": "",
                        "addedAt": "2019-09-23T09:04:29+00:00"
                      }
                    }
                  ],
                  "added": [
                    {
                      "data": {
                        "id": 2,
                        "username": "john.doe",
                        "firstName": "John",
                        "lastName": "Doe",
                        "avatarUrl": "",
                        "addedAt": "2019-09-23T09:04:29+00:00"
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

        $addedTeamMembers = $this->crowdin->teamMember->create(2, $params);
        $this->assertCount(1, $addedTeamMembers->getSkipped());
        $this->assertCount(1, $addedTeamMembers->getAdded());

        $this->assertInstanceOf(TeamMember::class, $addedTeamMembers->getSkipped()[0]);
        $this->assertInstanceOf(TeamMember::class, $addedTeamMembers->getAdded()[0]);
        $this->assertEquals(2, $addedTeamMembers->getSkipped()[0]->getId());
        $this->assertEquals(2, $addedTeamMembers->getAdded()[0]->getId());
        $this->assertEquals('John', $addedTeamMembers->getSkipped()[0]->getFirstName());
        $this->assertEquals('Doe', $addedTeamMembers->getAdded()[0]->getLastName());
    }

    public function testClear()
    {
        $this->mockRequestDelete('/teams/2/members');
        $this->crowdin->teamMember->clear(2);
    }

    public function testDelete()
    {
        $this->mockRequestDelete('/teams/2/members/2');
        $this->crowdin->teamMember->delete(2, 2);
    }
}
