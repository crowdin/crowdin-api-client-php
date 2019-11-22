<?php

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\StringTranslationApproval;
use CrowdinApiClient\ModelCollection;

class StringTranslationApprovalApiTest extends AbstractTestApi
{
    public function testList()
    {
        $this->mockRequest([
            'path' => '/projects/2/approvals',
            'method' => 'get',
            'response' => '{
                  "data": [
                    {
                      "data": {
                        "id": 190695,
                        "user": {
                          "id": 19,
                          "login": "john_doe"
                        },
                        "translationId": 190695,
                        "stringId": 2345,
                        "languageId": "uk",
                        "workflowStepId": 122,
                        "createdAt": "2019-09-19T12:42:12+00:00"
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

        $stringTranslationApprovals = $this->crowdin->stringTranslationApproval->list(2);

        $this->assertInstanceOf(ModelCollection::class, $stringTranslationApprovals);
        $this->assertCount(1, $stringTranslationApprovals);
        $this->assertInstanceOf(StringTranslationApproval::class, $stringTranslationApprovals[0]);
        $this->assertEquals(190695, $stringTranslationApprovals[0]->getId());
    }

    public function testCreate()
    {
        $params = ['translationId' => 200];

        $this->mockRequest([
            'path' => '/projects/2/approvals',
            'body' => $params,
            'method' => 'post',
            'response' => '{
                  "data": {
                    "id": 190695,
                    "user": {
                      "id": 19,
                      "login": "john_doe"
                    },
                    "translationId": 190695,
                    "stringId": 2345,
                    "languageId": "uk",
                    "workflowStepId": 122,
                    "createdAt": "2019-09-19T12:42:12+00:00"
                  }
                }'
        ]);

        $approval = $this->crowdin->stringTranslationApproval->create(2, $params);
        $this->assertInstanceOf(StringTranslationApproval::class, $approval);
        $this->assertEquals(190695, $approval->getId());
    }

    public function testGet()
    {
        $this->mockRequestGet('/projects/2/approvals/190695', '{
              "data": {
                "id": 190695,
                "user": {
                  "id": 19,
                  "login": "john_doe"
                },
                "translationId": 190695,
                "stringId": 2345,
                "languageId": "uk",
                "workflowStepId": 122,
                "createdAt": "2019-09-19T12:42:12+00:00"
              }
        }');

        $stringTranslationApproval = $this->crowdin->stringTranslationApproval->get(2, 190695);
        $this->assertInstanceOf(StringTranslationApproval::class, $stringTranslationApproval);
        $this->assertEquals(190695, $stringTranslationApproval->getId());
    }

    public function testDelete()
    {
        $this->mockRequestDelete('/projects/2/approvals/190695');
        $this->crowdin->stringTranslationApproval->delete(2, 190695);
    }
}
