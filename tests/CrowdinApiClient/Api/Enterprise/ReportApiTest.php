<?php

namespace CrowdinApiClient\Tests\Api\Enterprise;

use CrowdinApiClient\Model\DownloadFile;
use CrowdinApiClient\Model\Report;
use CrowdinApiClient\Model\ReportSettingsTemplate;
use CrowdinApiClient\ModelCollection;

class ReportApiTest extends AbstractTestApi
{
    public function testGenerate(): void
    {
        $this->mockRequest([
            'path' => '/reports',
            'method' => 'post',
            'response' => json_encode([
                'data' => [
                    'identifier' => '50fb3506-4127-4ba8-8296-f97dc7e3e0c3',
                    'status' => 'finished',
                    'progress' => 100,
                    'attributes' => [
                        'projectIds' => [0],
                        'format' => 'xlsx',
                        'reportName' => 'costs-estimation',
                        'schema' => [],
                    ],
                    'createdAt' => '2019-09-23T11:26:54+00:00',
                    'updatedAt' => '2019-09-23T11:26:54+00:00',
                    'startedAt' => '2019-09-23T11:26:54+00:00',
                    'finishedAt' => '2019-09-23T11:26:54+00:00',
                ],
            ]),
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
                        ],
                    ],
                    'mtMatch' => [
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
                'groupBy' => 'user',
                'dateFrom' => '2019-09-23T07:00:14+00:00',
                'dateTo' => '2019-09-27T07:00:14+00:00',
                'userIds' => [13],
            ],
        ]);

        $this->assertInstanceOf(Report::class, $report);
        $this->assertEquals('50fb3506-4127-4ba8-8296-f97dc7e3e0c3', $report->getIdentifier());
    }

    private const REPORT_ID = '50fb3506-4127-4ba8-8296-f97dc7e3e0c3';

    private function reportResponse(): string
    {
        return json_encode([
            'data' => [
                'identifier' => self::REPORT_ID,
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
            ],
        ]);
    }

    private function downloadResponse(): string
    {
        return json_encode([
            'data' => [
                'url' => 'https://production-enterprise-importer.downloads.crowdin.com/report.xlsx',
                'expireIn' => '2019-09-20T10:31:21+00:00',
            ],
        ]);
    }

    private function templateData(): array
    {
        return [
            'id' => 12,
            'projectId' => 2,
            'groupId' => null,
            'name' => 'Default template',
            'currency' => 'USD',
            'unit' => 'words',
            'config' => [
                'baseRates' => ['fullTranslation' => 0.1, 'proofread' => 0.12],
                'individualRates' => [],
                'netRateSchemes' => ['tmMatch' => [], 'mtMatch' => [], 'aiMatch' => [], 'suggestionMatch' => []],
                'calculateInternalMatches' => false,
                'includePreTranslatedStrings' => false,
                'excludeApprovalsForEditedTranslations' => false,
                'preTranslatedStringsCategorizationAdjustment' => false,
            ],
            'isPublic' => false,
            'createdAt' => '2023-09-23T11:26:54+00:00',
            'updatedAt' => '2023-09-23T11:26:54+00:00',
        ];
    }

    public function testGet(): void
    {
        $this->mockRequestGet('/reports/' . self::REPORT_ID, $this->reportResponse());

        $report = $this->crowdin->report->get(self::REPORT_ID);

        $this->assertInstanceOf(Report::class, $report);
        $this->assertEquals(self::REPORT_ID, $report->getIdentifier());
    }

    public function testDownload(): void
    {
        $this->mockRequestGet('/reports/' . self::REPORT_ID . '/download', $this->downloadResponse());

        $file = $this->crowdin->report->download(self::REPORT_ID);

        $this->assertInstanceOf(DownloadFile::class, $file);
        $this->assertEquals('https://production-enterprise-importer.downloads.crowdin.com/report.xlsx', $file->getUrl());
    }

    public function testGenerateProjectReport(): void
    {
        $data = ['name' => 'costs-estimation', 'schema' => ['unit' => 'words', 'format' => 'xlsx']];

        $this->mockRequest([
            'path' => '/projects/2/reports',
            'method' => 'post',
            'body' => json_encode($data),
            'response' => $this->reportResponse(),
        ]);

        $report = $this->crowdin->report->generateProjectReport(2, $data);

        $this->assertInstanceOf(Report::class, $report);
        $this->assertEquals(self::REPORT_ID, $report->getIdentifier());
    }

    public function testGetProjectReport(): void
    {
        $this->mockRequestGet('/projects/2/reports/' . self::REPORT_ID, $this->reportResponse());

        $report = $this->crowdin->report->getProjectReport(2, self::REPORT_ID);

        $this->assertInstanceOf(Report::class, $report);
        $this->assertEquals(self::REPORT_ID, $report->getIdentifier());
    }

    public function testDownloadProjectReport(): void
    {
        $this->mockRequestGet('/projects/2/reports/' . self::REPORT_ID . '/download', $this->downloadResponse());

        $file = $this->crowdin->report->downloadProjectReport(2, self::REPORT_ID);

        $this->assertInstanceOf(DownloadFile::class, $file);
        $this->assertEquals('https://production-enterprise-importer.downloads.crowdin.com/report.xlsx', $file->getUrl());
    }

    public function testListReportSettingsTemplates(): void
    {
        $this->mockRequestGet(
            '/reports/settings-templates?projectId=2',
            json_encode([
                'data' => [['data' => $this->templateData()]],
                'pagination' => ['offset' => 0, 'limit' => 25],
            ])
        );

        $templates = $this->crowdin->report->listReportSettingsTemplates(['projectId' => 2]);

        $this->assertInstanceOf(ModelCollection::class, $templates);
        $this->assertCount(1, $templates);
        $this->assertInstanceOf(ReportSettingsTemplate::class, $templates[0]);
        $this->assertEquals(12, $templates[0]->getId());
    }

    public function testGetReportSettingsTemplate(): void
    {
        $this->mockRequestGet('/reports/settings-templates/12', json_encode(['data' => $this->templateData()]));

        $template = $this->crowdin->report->getReportSettingsTemplate(12);

        $this->assertInstanceOf(ReportSettingsTemplate::class, $template);
        $this->assertEquals(12, $template->getId());
        $this->assertEquals(2, $template->getProjectId());
        $this->assertNull($template->getGroupId());
    }

    public function testCreateReportSettingsTemplate(): void
    {
        $data = $this->templateData();
        unset($data['id'], $data['groupId'], $data['createdAt'], $data['updatedAt']);

        $this->mockRequest([
            'path' => '/reports/settings-templates',
            'method' => 'post',
            'body' => json_encode($data),
            'response' => json_encode(['data' => $this->templateData()]),
        ]);

        $template = $this->crowdin->report->createReportSettingsTemplate($data);

        $this->assertInstanceOf(ReportSettingsTemplate::class, $template);
        $this->assertEquals(12, $template->getId());
    }

    public function testCreateReportSettingsTemplateFromModelSkipsReadOnlyKeysAndNulls(): void
    {
        $template = new ReportSettingsTemplate($this->templateData());
        $expected = $template->toArray();
        unset($expected['id'], $expected['groupId'], $expected['isGlobal'], $expected['createdAt'], $expected['updatedAt']);

        $this->mockRequest([
            'path' => '/reports/settings-templates',
            'method' => 'post',
            'body' => json_encode($expected),
            'response' => json_encode(['data' => $this->templateData()]),
        ]);

        $this->crowdin->report->createReportSettingsTemplate($template->toArray());
    }

    public function testUpdateReportSettingsTemplate(): void
    {
        $template = new ReportSettingsTemplate($this->templateData());
        $template->setName('New name');

        $this->mockRequest([
            'path' => '/reports/settings-templates/12',
            'method' => 'patch',
            'body' => json_encode([['op' => 'replace', 'path' => '/name', 'value' => 'New name']]),
            'response' => json_encode(['data' => array_merge($this->templateData(), ['name' => 'New name'])]),
        ]);

        $updated = $this->crowdin->report->updateReportSettingsTemplate($template);

        $this->assertInstanceOf(ReportSettingsTemplate::class, $updated);
        $this->assertEquals('New name', $updated->getName());
    }

    public function testDeleteReportSettingsTemplate(): void
    {
        $this->mockRequestDelete('/reports/settings-templates/12');

        $this->crowdin->report->deleteReportSettingsTemplate(12);
    }
}
