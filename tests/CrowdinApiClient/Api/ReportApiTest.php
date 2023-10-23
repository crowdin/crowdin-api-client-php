<?php

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\DownloadFile;
use CrowdinApiClient\Model\Report;

class ReportApiTest extends AbstractTestApi
{
    public function testGenerate(): void
    {
        $this->mockRequest([
            'path' => '/projects/124/reports',
            'method' => 'post',
            'response' => '{
                  "identifier": "50fb3506-4127-4ba8-8296-f97dc7e3e0c3",
                  "status": "finished",
                  "progress": 100,
                  "attributes": {
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
            [
                'name' => 'costs-estimation-pe',
                'schema' =>
                    [
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
                        ],
                        'calculateInternalMatches' => false,
                        'includePreTranslatedStrings' => false,
                        'languageId' => 'ach',
                        'fileIds' => [138],
                        'directoryIds' => [11],
                        'branchIds' => [18],
                        'dateFrom' => '2019-09-23T07:00:14+00:00',
                        'dateTo' => '2019-09-27T07:00:14+00:00',
                        'labelIds' => [13],
                        'labelIncludeType' => 'strings_with_label',
                    ],
            ]
        ];
        $report = $this->crowdin->report->generate(124, $data);

        $this->assertInstanceOf(Report::class, $report);
        $this->assertEquals('50fb3506-4127-4ba8-8296-f97dc7e3e0c3', $report->getIdentifier());
    }

    public function testGet()
    {
        $this->mockRequestGet('/projects/124/reports/50fb3506-4127-4ba8-8296-f97dc7e3e0c3', '{
              "identifier": "50fb3506-4127-4ba8-8296-f97dc7e3e0c3",
              "status": "finished",
              "progress": 100,
              "attributes": {
                "format": "xlsx",
                "reportName": "costs-estimation",
                "schema": {}
              },
              "createdAt": "2019-09-23T11:26:54+00:00",
              "updatedAt": "2019-09-23T11:26:54+00:00",
              "startedAt": "2019-09-23T11:26:54+00:00",
              "finishedAt": "2019-09-23T11:26:54+00:00"
            }');

        $report = $this->crowdin->report->get(124, '50fb3506-4127-4ba8-8296-f97dc7e3e0c3');
        $this->assertInstanceOf(Report::class, $report);
        $this->assertEquals('50fb3506-4127-4ba8-8296-f97dc7e3e0c3', $report->getIdentifier());
    }

    public function testDownload()
    {
        $this->mockRequestGet('/projects/124/reports/50fb3506-4127-4ba8-8296-f97dc7e3e0c3/download', '{
              "data": {
                "url": "https://production-enterprise-importer.downloads.crowdin.com/992000002/2/14.xliff?response-content-disposition=attachment%3B%20filename%3D%22APP.xliff%22&X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAIGJKLQV66ZXPMMEA%2F20190920%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20190920T093121Z&X-Amz-SignedHeaders=host&X-Amz-Expires=3600&X-Amz-Signature=439ebd69a1b7e4c23e6d17891a491c94f832e0c82e4692dedb35a6cd1e624b62",
                "expireIn": "2019-09-20T10:31:21+00:00"
              }
            }');
        $downloadFile = $this->crowdin->report->download(124, '50fb3506-4127-4ba8-8296-f97dc7e3e0c3');
        $this->assertInstanceOf(DownloadFile::class, $downloadFile);
        $this->assertEquals('https://production-enterprise-importer.downloads.crowdin.com/992000002/2/14.xliff?response-content-disposition=attachment%3B%20filename%3D%22APP.xliff%22&X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAIGJKLQV66ZXPMMEA%2F20190920%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20190920T093121Z&X-Amz-SignedHeaders=host&X-Amz-Expires=3600&X-Amz-Signature=439ebd69a1b7e4c23e6d17891a491c94f832e0c82e4692dedb35a6cd1e624b62', $downloadFile->getUrl());
    }
}
