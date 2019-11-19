<?php

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\Group;

class GroupApiTest extends AbstractTestApi
{
    public function testList()
    {
        $this->mockRequest([
            'uri' => 'https://organization_domain.crowdin.com/api/v2/groups',
            'method' => 'get',
            'response' => '{
                  "data": [
                    {
                      "data": {
                        "id": 1,
                        "name": "KB materials",
                        "description": "KB localization materials",
                        "parentId": 2,
                        "organizationId": 200000299,
                        "userId": 6,
                        "subgroupsCount": 0,
                        "projectsCount": 1,
                        "createdAt": "2019-09-20T11:11:05+00:00",
                        "updatedAt": "2019-09-20T12:22:20+00:00"
                      }
                    }
                  ],
                  "pagination": [
                    {
                      "offset": 0,
                      "limit": 0
                    }
                  ]
                }',
        ]);

        $groups = $this->crowdin->group->list();

        $this->assertIsArray($groups);
        $this->assertCount(1, $groups);
        $this->assertInstanceOf(Group::class, $groups[0]);
    }

    public function testCreate()
    {
        $this->mockRequest([
            'uri' => 'https://organization_domain.crowdin.com/api/v2/groups',
            'method' => 'post',
            'response' => '{
              "data": {
                "id": 1,
                "name": "KB materials",
                "description": "KB localization materials",
                "parentId": 2,
                "organizationId": 200000299,
                "userId": 6,
                "subgroupsCount": 0,
                "projectsCount": 1,
                "createdAt": "2019-09-20T11:11:05+00:00",
                "updatedAt": "2019-09-20T12:22:20+00:00"
              }
            }',
        ]);

        $group = $this->crowdin->group->create([
            'name' => 'KB materials',
            'description' => 'KB localization materials'
        ]);

        $this->assertInstanceOf(Group::class, $group);

        $this->assertEquals(1, $group->getId());
    }

    public function testGetAndUpdate()
    {
        $this->mockRequestGet('/groups/1', '{
              "data": {
                "id": 1,
                "name": "KB materials",
                "description": "KB localization materials",
                "parentId": 2,
                "organizationId": 200000299,
                "userId": 6,
                "subgroupsCount": 0,
                "projectsCount": 1,
                "createdAt": "2019-09-20T11:11:05+00:00",
                "updatedAt": "2019-09-20T12:22:20+00:00"
              }
        }');

        $group = $this->crowdin->group->get(1);

        $this->assertInstanceOf(Group::class, $group);
        $this->assertEquals(1, $group->getId());

        $group->setName('edit test');

        $this->mockRequestPath('/groups/1', '{
              "data": {
                "id": 1,
                "name": "edit test",
                "description": "KB localization materials",
                "parentId": 2,
                "organizationId": 200000299,
                "userId": 6,
                "subgroupsCount": 0,
                "projectsCount": 1,
                "createdAt": "2019-09-20T11:11:05+00:00",
                "updatedAt": "2019-09-20T12:22:20+00:00"
              }
        }');

        $this->crowdin->group->update($group);

        $this->assertInstanceOf(Group::class, $group);
        $this->assertEquals(1, $group->getId());
        $this->assertEquals('edit test', $group->getName());
    }

    public function testDelete()
    {
        $this->mockRequest([
            'uri' => 'https://organization_domain.crowdin.com/api/v2/groups/1',
            'method' => 'delete',
        ]);

        $this->crowdin->group->delete(1);
    }
}
