<?php

namespace Crowdin\Tests\Api;

use Crowdin\Model\Report;

class ReportApiTest extends AbstractTestApi
{
    public function testGenerate()
    {
        $this->mockRequestTest([
            'uri' => 'https://organization_domain.crowdin.com/api/v2/projects/124/reports',
            'method' => 'post',
            'response' => '{
                  "identifier": "50fb3506-4127-4ba8-8296-f97dc7e3e0c3",
                  "status": "finished",
                  "progress": 100,
                  "attributes": {
                    "organizationId": 10,
                    "projectId": 124,
                    "format": "xlsx",
                    "reportName": "costs-estimation",
                    "schema": {}
                  },
                  "createdAt": "2019-09-23T11:26:54+00:00",
                  "updatedAt": "2019-09-23T11:26:54+00:00",
                  "startedAt": "2019-09-23T11:26:54+00:00",
                  "finishedAt": "2019-09-23T11:26:54+00:00",
                  "eta": "1 second"
                }'
        ]);

        $report = $this->crowdin->report->generate(124, ['name' => 'costs-estimation', ['schema' => [
                "unit" => "words",
                "currency" => "USD",
                "languageId" => "ach",
                "format" => "xlsx",
                "stepTypes" => [
                    [
                        "type" => "Translate",
                        "mode" => "simple",
                        "regularRates" => [
                            [
                                "mode" => "tm_match",
                                "value" => 0.1
                            ]
                        ]
                    ]
                 ]
            ]]
        ]);

        $this->assertInstanceOf(Report::class, $report);
    }
}
