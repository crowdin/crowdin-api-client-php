<?php

namespace CrowdinApiClient\Tests\Api\Enterprise;

use CrowdinApiClient\Model\Enterprise\Group;
use CrowdinApiClient\Model\Report;
use CrowdinApiClient\ModelCollection;

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

        $this->assertInstanceOf(ModelCollection::class, $groups);
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

    public function testReport(): void
    {
        $this->mockRequest([
            'path' => '/groups/123/reports',
            'method' => 'post',
            'response' => '{
                  "identifier": "50fb3506-4127-4ba8-8296-f97dc7e3e0c3",
                  "status": "finished",
                  "progress": 100,
                  "attributes": {
                    "projectIds": [0],
                    "format": "xlsx",
                    "reportName": "costs-estimation",
                    "schema": {}
                  },
                  "createdAt": "2019-09-23T11:26:54+00:00",
                  "updatedAt": "2019-09-23T11:26:54+00:00",
                  "startedAt": "2019-09-23T11:26:54+00:00",
                  "finishedAt": "2019-09-23T11:26:54+00:00"
                }'
        ]);

        $data = [
            'name' => 'group-translation-costs-pe',
            'schema' => [
                'projectIds' => [13],
                'unit' => 'words',
                'currency' => 'USD',
                'format' => 'xlsx',
                'baseRates' => [
                    'fullTranslation' => 0.1,
                    'proofread' => 0.12,
                ],
                'individualRates' => [
                    [
                        'languageIds' => ['uk'],
                        'userIds' => [1],
                        'fullTranslation' => 0.1,
                        'proofread' => 0.12,
                    ],
                ],
                'netRateSchemes' => [
                    'tmMatch' => [
                        [
                            'matchType' => 'perfect',
                            'price' => 0.1,
                        ]
                    ],
                    'mtMatch' => [
                        [
                            'matchType' => '100',
                            'price' => 0.1,
                        ]
                    ],
                    'suggestionMatch' => [
                        [
                            'matchType' => '100',
                            'price' => 0.1,
                        ]
                    ],
                ],
                'groupBy' => 'user',
                'dateFrom' => '2019-09-23T07:00:14+00:00',
                'dateTo' => '2019-09-27T07:00:14+00:00',
                'userIds' => [13],
            ],
        ];

        $report = $this->crowdin->group->report(123, $data);

        $this->assertInstanceOf(Report::class, $report);
        $this->assertEquals('50fb3506-4127-4ba8-8296-f97dc7e3e0c3', $report->getIdentifier());
    }
}
