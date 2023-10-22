<?php

namespace CrowdinApiClient\Tests\Api\Enterprise;

use CrowdinApiClient\Model\Report;

class ReportApiTest extends AbstractTestApi
{
    public function testGenerate(): void
    {
        $this->mockRequest([
            'path' => '/reports',
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

        $report = $this->crowdin->report->generate([
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
            ]
        ]);

        $this->assertInstanceOf(Report::class, $report);
        $this->assertEquals('50fb3506-4127-4ba8-8296-f97dc7e3e0c3', $report->getIdentifier());
    }
}
