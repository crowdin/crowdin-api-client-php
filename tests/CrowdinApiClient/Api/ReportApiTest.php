<?php

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\DownloadFile;
use CrowdinApiClient\Model\Report;
use CrowdinApiClient\Model\ReportSettingsTemplate;
use CrowdinApiClient\Model\ReportSettingsTemplateConfig;
use CrowdinApiClient\ModelCollection;

class ReportApiTest extends AbstractTestApi
{
    public function testGenerate(): void
    {
        $this->mockRequest([
            'path' => '/projects/124/reports',
            'method' => 'post',
            'response' => json_encode([
                'identifier' => '50fb3506-4127-4ba8-8296-f97dc7e3e0c3',
                'status' => 'finished',
                'progress' => 100,
                'attributes' => [
                    'format' => 'xlsx',
                    'reportName' => 'costs-estimation',
                    'schema' => [],
                ],
                'createdAt' => '2019-09-23T11:26:54+00:00',
                'updatedAt' => '2019-09-23T11:26:54+00:00',
                'startedAt' => '2019-09-23T11:26:54+00:00',
                'finishedAt' => '2019-09-23T11:26:54+00:00',
            ]),
        ]);

        $data = [
            [
                'name' => 'costs-estimation-pe',
                'schema' => [
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
                            ],
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
            ],
        ];

        $report = $this->crowdin->report->generate(124, $data);

        $this->assertInstanceOf(Report::class, $report);
        $this->assertEquals('50fb3506-4127-4ba8-8296-f97dc7e3e0c3', $report->getIdentifier());
    }

    public function testGet(): void
    {
        $this->mockRequestGet(
            '/projects/124/reports/50fb3506-4127-4ba8-8296-f97dc7e3e0c3',
            json_encode([
                'identifier' => '50fb3506-4127-4ba8-8296-f97dc7e3e0c3',
                'status' => 'finished',
                'progress' => 100,
                'attributes' => [
                    'format' => 'xlsx',
                    'reportName' => 'costs-estimation',
                    'schema' => [],
                ],
                'createdAt' => '2019-09-23T11:26:54+00:00',
                'updatedAt' => '2019-09-23T11:26:54+00:00',
                'startedAt' => '2019-09-23T11:26:54+00:00',
                'finishedAt' => '2019-09-23T11:26:54+00:00',
            ])
        );

        $report = $this->crowdin->report->get(124, '50fb3506-4127-4ba8-8296-f97dc7e3e0c3');

        $this->assertInstanceOf(Report::class, $report);
        $this->assertEquals('50fb3506-4127-4ba8-8296-f97dc7e3e0c3', $report->getIdentifier());
    }

    public function testDownload(): void
    {
        $this->mockRequestGet(
            '/projects/124/reports/50fb3506-4127-4ba8-8296-f97dc7e3e0c3/download',
            json_encode([
                'data' => [
                    'url' => 'https://production-enterprise-importer.downloads.crowdin.com/992000002/2/14.xliff',
                    'expireIn' => '2019-09-20T10:31:21+00:00',
                ],
            ])
        );

        $downloadFile = $this->crowdin->report->download(124, '50fb3506-4127-4ba8-8296-f97dc7e3e0c3');

        $this->assertInstanceOf(DownloadFile::class, $downloadFile);
        $this->assertEquals(
            'https://production-enterprise-importer.downloads.crowdin.com/992000002/2/14.xliff',
            $downloadFile->getUrl()
        );
    }

    public function testListReportSettingsTemplates(): void
    {
        $this->mockRequestGet(
            '/projects/87/reports/settings-templates',
            json_encode([
                'data' => [
                    [
                        'data' => [
                            'id' => 12,
                            'name' => 'Default template',
                            'currency' => 'UAH',
                            'unit' => 'words',
                            'config' => [
                                'baseRates' => [
                                    'fullTranslation' => 0.1,
                                    'proofread' => 0.12,
                                ],
                                'individualRates' => [
                                    [
                                        'languageIds' => ['uk'],
                                        'userIds' => [8],
                                        'fullTranslation' => 0.1,
                                        'proofread' => 0.12,
                                    ],
                                ],
                                'netRateSchemes' => [
                                    'tmMatch' => [
                                        [
                                            'matchType' => 'perfect',
                                            'price' => 0.1,
                                        ],
                                        [
                                            'matchType' => '100',
                                            'price' => 0.2,
                                        ],
                                    ],
                                    'mtMatch' => [
                                        [
                                            'matchType' => '100',
                                            'price' => 0.1,
                                        ],
                                    ],
                                    'aiMatch' => [
                                        [
                                            'matchType' => '100',
                                            'price' => 0.1,
                                        ],
                                    ],
                                    'suggestionMatch' => [
                                        [
                                            'matchType' => '100',
                                            'price' => 0.1,
                                        ],
                                    ],
                                ],
                            ],
                            'isPublic' => true,
                            'isGlobal' => true,
                            'createdAt' => '2025-01-23T15:23:11+00:00',
                            'updatedAt' => '2025-01-23T15:35:49+00:00',
                        ],
                    ],
                ],
                'pagination' => [
                    'offset' => 0,
                    'limit' => 25,
                ],
            ])
        );

        $reportSettingsTemplates = $this->crowdin->report->listReportSettingsTemplates(87);

        $this->assertInstanceOf(ModelCollection::class, $reportSettingsTemplates);
        $this->assertCount(1, $reportSettingsTemplates);
        $this->assertInstanceOf(ReportSettingsTemplate::class, $reportSettingsTemplates[0]);
        $this->assertEquals('Default template', $reportSettingsTemplates[0]->getName());
    }

    public function testGetReportSettingsTemplate(): void
    {
        $this->mockRequestGet(
            '/projects/87/reports/settings-templates/12',
            json_encode([
                'data' => [
                    'id' => 12,
                    'name' => 'Default template',
                    'currency' => 'UAH',
                    'unit' => 'words',
                    'config' => [
                        'baseRates' => [
                            'fullTranslation' => 0.1,
                            'proofread' => 0.12,
                        ],
                        'individualRates' => [
                            [
                                'languageIds' => ['uk'],
                                'userIds' => [8],
                                'fullTranslation' => 0.1,
                                'proofread' => 0.12,
                            ],
                        ],
                        'netRateSchemes' => [
                            'tmMatch' => [
                                [
                                    'matchType' => 'perfect',
                                    'price' => 0.1,
                                ],
                                [
                                    'matchType' => '100',
                                    'price' => 0.2,
                                ],
                            ],
                            'mtMatch' => [
                                [
                                    'matchType' => '100',
                                    'price' => 0.1,
                                ],
                            ],
                            'aiMatch' => [
                                [
                                    'matchType' => '100',
                                    'price' => 0.1,
                                ],
                            ],
                            'suggestionMatch' => [
                                [
                                    'matchType' => '100',
                                    'price' => 0.1,
                                ],
                            ],
                        ],
                    ],
                    'isPublic' => true,
                    'isGlobal' => true,
                    'createdAt' => '2025-01-23T15:23:11+00:00',
                    'updatedAt' => '2025-01-23T15:35:49+00:00',
                ],
            ])
        );

        $reportSettingsTemplate = $this->crowdin->report->getReportSettingsTemplate(87, 12);

        $this->assertInstanceOf(ReportSettingsTemplate::class, $reportSettingsTemplate);
        $this->assertEquals('Default template', $reportSettingsTemplate->getName());
    }

    public function testCreateReportSettingsTemplate(): void
    {
        $this->mockRequest([
            'path' => '/projects/87/reports/settings-templates',
            'method' => 'post',
            'response' => json_encode([
                'data' => [
                    'id' => 12,
                    'name' => 'Default template',
                    'currency' => 'UAH',
                    'unit' => 'words',
                    'config' => [
                        'baseRates' => [
                            'fullTranslation' => 0.1,
                            'proofread' => 0.12,
                        ],
                        'individualRates' => [
                            [
                                'languageIds' => ['uk'],
                                'userIds' => [8],
                                'fullTranslation' => 0.1,
                                'proofread' => 0.12,
                            ],
                        ],
                        'netRateSchemes' => [
                            'tmMatch' => [
                                [
                                    'matchType' => 'perfect',
                                    'price' => 0.1,
                                ],
                                [
                                    'matchType' => '100',
                                    'price' => 0.2,
                                ],
                            ],
                            'mtMatch' => [
                                [
                                    'matchType' => '100',
                                    'price' => 0.1,
                                ],
                            ],
                            'aiMatch' => [
                                [
                                    'matchType' => '100',
                                    'price' => 0.1,
                                ],
                            ],
                            'suggestionMatch' => [
                                [
                                    'matchType' => '100',
                                    'price' => 0.1,
                                ],
                            ],
                        ],
                    ],
                    'isPublic' => true,
                    'isGlobal' => true,
                    'createdAt' => '2025-01-23T15:23:11+00:00',
                    'updatedAt' => '2025-01-23T15:35:49+00:00',
                ],
            ]),
        ]);

        $data = [
            'name' => 'Default template',
            'currency' => 'UAH',
            'unit' => 'words',
            'config' => [
                'baseRates' => [
                    'fullTranslation' => 0.1,
                    'proofread' => 0.12,
                ],
                'individualRates' => [
                    [
                        'languageIds' => ['uk'],
                        'userIds' => [8],
                        'fullTranslation' => 0.1,
                        'proofread' => 0.12,
                    ],
                ],
                'netRateSchemes' => [
                    'tmMatch' => [
                        [
                            'matchType' => 'perfect',
                            'price' => 0.1,
                        ],
                        [
                            'matchType' => '100',
                            'price' => 0.2,
                        ],
                    ],
                    'mtMatch' => [
                        [
                            'matchType' => '100',
                            'price' => 0.1,
                        ],
                    ],
                    'aiMatch' => [
                        [
                            'matchType' => '100',
                            'price' => 0.1,
                        ],
                    ],
                    'suggestionMatch' => [
                        [
                            'matchType' => '100',
                            'price' => 0.1,
                        ],
                    ],
                ],
            ],
        ];

        $reportSettingsTemplate = $this->crowdin->report->createReportSettingsTemplate(87, $data);

        $this->assertInstanceOf(ReportSettingsTemplate::class, $reportSettingsTemplate);
        $this->assertEquals('Default template', $reportSettingsTemplate->getName());
        $this->assertEquals('UAH', $reportSettingsTemplate->getCurrency());
        $this->assertInstanceOf(ReportSettingsTemplateConfig::class, $reportSettingsTemplate->getConfig());
    }

    public function testUpdateReportSettingsTemplate(): void
    {
        $this->mockRequest([
            'path' => '/projects/87/reports/settings-templates/12',
            'method' => 'patch',
            'response' => json_encode([
                'id' => 12,
                'name' => 'New name',
                'currency' => 'UAH',
                'unit' => 'words',
                'config' => [
                    'baseRates' => [
                        'fullTranslation' => 0.1,
                        'proofread' => 0.12,
                    ],
                    'individualRates' => [
                        [
                            'languageIds' => ['uk'],
                            'userIds' => [8],
                            'fullTranslation' => 0.1,
                            'proofread' => 0.12,
                        ],
                    ],
                    'netRateSchemes' => [
                        'tmMatch' => [
                            [
                                'matchType' => 'perfect',
                                'price' => 0.1,
                            ],
                            [
                                'matchType' => '100',
                                'price' => 0.2,
                            ],
                        ],
                        'mtMatch' => [
                            [
                                'matchType' => '100',
                                'price' => 0.1,
                            ],
                        ],
                        'aiMatch' => [
                            [
                                'matchType' => '100',
                                'price' => 0.1,
                            ],
                        ],
                        'suggestionMatch' => [
                            [
                                'matchType' => '100',
                                'price' => 0.1,
                            ],
                        ],
                    ],
                ],
                'isPublic' => true,
                'isGlobal' => true,
                'createdAt' => '2025-01-23T15:23:11+00:00',
                'updatedAt' => '2025-01-23T15:35:49+00:00',
            ]),
        ]);

        $reportSettingsTemplate = new ReportSettingsTemplate([
            'id' => 12,
            'name' => 'Default template',
            'currency' => 'UAH',
            'unit' => 'words',
            'config' => [
                'baseRates' => [
                    'fullTranslation' => 0.1,
                    'proofread' => 0.12,
                ],
                'individualRates' => [
                    [
                        'languageIds' => ['uk'],
                        'userIds' => [8],
                        'fullTranslation' => 0.1,
                        'proofread' => 0.12,
                    ],
                ],
                'netRateSchemes' => [
                    'tmMatch' => [
                        [
                            'matchType' => 'perfect',
                            'price' => 0.1,
                        ],
                        [
                            'matchType' => '100',
                            'price' => 0.2,
                        ],
                    ],
                    'mtMatch' => [
                        [
                            'matchType' => '100',
                            'price' => 0.1,
                        ],
                    ],
                    'aiMatch' => [
                        [
                            'matchType' => '100',
                            'price' => 0.1,
                        ],
                    ],
                    'suggestionMatch' => [
                        [
                            'matchType' => '100',
                            'price' => 0.1,
                        ],
                    ],
                ],
            ],
            'isPublic' => true,
            'isGlobal' => true,
            'createdAt' => '2025-01-23T15:23:11+00:00',
            'updatedAt' => '2025-01-23T15:35:49+00:00',
        ]);

        $reportSettingsTemplate->setName('New name');

        $updatedTemplate = $this->crowdin->report->updateReportSettingsTemplate(87, $reportSettingsTemplate);

        $this->assertInstanceOf(ReportSettingsTemplate::class, $updatedTemplate);
        $this->assertSame('New name', $updatedTemplate->getName());
    }

    public function testDeleteReportSettingsTemplate(): void
    {
        $this->mockRequestDelete('/projects/87/reports/settings-templates/12');

        $this->crowdin->report->deleteReportSettingsTemplate(87, 12);
    }
}
