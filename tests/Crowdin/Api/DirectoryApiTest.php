<?php

namespace Crowdin\Tests\Api;

use Crowdin\Model\Directory;

class DirectoryApiTest extends AbstractTestApi
{
    public function testList()
    {
        $this->mockRequestTest([
            'uri' => 'https://organization_domain.crowdin.com/api/v2/projects/2/directories',
            'method' => 'get',
            'response' => '{
              "data": [
                {
                  "data": {
                    "id": 4,
                    "projectId": 2,
                    "branchId": 34,
                    "parentId": 0,
                    "name": "main",
                    "title": "<Description materials>",
                    "exportPattern": "/localization/%locale%/%file_name%",
                    "priority": "normal",
                    "createdAt": "2019-09-19T14:14:00+00:00",
                    "updatedAt": "2019-09-19T14:14:00+00:00"
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

        $directories = $this->crowdin->directory->list(2);

        $this->assertIsArray($directories);
        $this->assertCount(1, $directories);
        $this->assertInstanceOf(Directory::class, $directories[0]);
        $this->assertEquals(4, $directories[0]->getId());
    }
}
