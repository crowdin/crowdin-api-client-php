<?php

namespace Crowdin\Tests\Api;

use Crowdin\Model\StringTranslationApproval;

class StringTranslationApprovalApiTest extends AbstractTestApi
{
    public function testList()
    {
        $this->mockRequestTest([
            'uri' => 'https://organization_domain.crowdin.com/api/v2/projects/2/approvals',
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

        $this->assertIsArray($stringTranslationApprovals);
        $this->assertCount(1, $stringTranslationApprovals);
        $this->assertInstanceOf(StringTranslationApproval::class, $stringTranslationApprovals[0]);
        $this->assertEquals(190695, $stringTranslationApprovals[0]->getId());
    }
}
