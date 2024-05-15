<?php

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\DownloadFile;
use CrowdinApiClient\Model\ReportArchive;
use CrowdinApiClient\Model\ReportArchiveExport;
use CrowdinApiClient\ModelCollection;

class ReportArchiveApiTest extends AbstractTestApi
{

    public function testList()
    {
        $this->mockRequest([
            'path' => '/users/1/reports/archives',
            'method' => 'get',
            'response' => '{
              "data": [
                {
                  "data": {
                    "id": 12,
                    "scopeType": "project",
                    "scopeId": 35,
                    "userId": 35,
                    "name": "string",
                    "webUrl": "https://crowdin.com/project/project-identifier/reports/archive/1",
                    "scheme": {},
                    "createdAt": "2019-09-23T11:26:54+00:00"
                  }
                }
              ],
              "pagination": {
                "offset": 0,
                "limit": 25
              }
            }'
        ]);

        $reportArchives = $this->crowdin->reportArchive->list(1);
        $this->assertInstanceOf(ModelCollection::class, $reportArchives);
        $this->assertCount(1, $reportArchives);
        $this->assertInstanceOf(ReportArchive::class, $reportArchives[0]);
        $this->assertEquals(12, $reportArchives[0]->getId());
    }

    public function testGet()
    {
        $this->mockRequest([
            'path' => '/users/1/reports/archives/12',
            'method' => 'get',
            'response' => '{
              "data": {
                "id": 12,
                "scopeType": "project",
                "scopeId": 35,
                "userId": 35,
                "name": "report archive name",
                "webUrl": "https://crowdin.com/project/project-identifier/reports/archive/1",
                "scheme": {},
                "createdAt": "2019-09-23T11:26:54+00:00"
              }
            }',
        ]);

        $reportArchive = $this->crowdin->reportArchive->get(1, 12);
        $this->assertInstanceOf(ReportArchive::class, $reportArchive);
        $this->assertEquals(12, $reportArchive->getId());
        $this->assertEquals('report archive name', $reportArchive->getName());
    }

    public function testDelete()
    {
        $this->mockRequestDelete('/users/1/reports/archives/12');
        $this->crowdin->reportArchive->delete(1, 12);
    }

    public function testExport()
    {
        $params = [];
        $this->mockRequest([
            'path' => '/users/1/reports/archives/12/exports',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => '{
              "data": {
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
              }
            }'
        ]);

        $export = $this->crowdin->reportArchive->export(1, 12);

        $this->assertInstanceOf(ReportArchiveExport::class, $export);
        $this->assertEquals('50fb3506-4127-4ba8-8296-f97dc7e3e0c3', $export->getIdentifier());
        $this->assertEquals('2019-09-23T11:26:54+00:00', $export->getCreatedAt());
        $this->assertEquals('2019-09-23T11:26:54+00:00', $export->getStartedAt());
        $this->assertEquals([
            'format' => 'xlsx',
            'reportName' => 'costs-estimation',
            'schema' => [],
        ], $export->getAttributes());
    }

    public function testCheckExportStatus()
    {
        $this->mockRequestGet('/users/1/reports/archives/12/exports/50fb3506-4127-4ba8-8296-f97dc7e3e0c3', '{
          "data": {
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
          }
        }');

        $export = $this->crowdin->reportArchive->checkExportStatus(1, 12, '50fb3506-4127-4ba8-8296-f97dc7e3e0c3');

        $this->assertInstanceOf(ReportArchiveExport::class, $export);
        $this->assertEquals('50fb3506-4127-4ba8-8296-f97dc7e3e0c3', $export->getIdentifier());
        $this->assertEquals('finished', $export->getStatus());
        $this->assertEquals(100, $export->getProgress());
        $this->assertEquals('2019-09-23T11:26:54+00:00', $export->getUpdatedAt());
        $this->assertEquals('2019-09-23T11:26:54+00:00', $export->getFinishedAt());
    }

    public function testDownloadReportArchive()
    {
        $this->mockRequestGet('/users/1/reports/archives/12/exports/50fb3506-4127-4ba8-8296-f97dc7e3e0c3/download', '{
          "data": {
            "url": "https://production-enterprise-importer.downloads.crowdin.com/992000002/2/14.xliff?response-content-disposition=attachment%3B%20filename%3D%22APP.xliff%22&X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAIGJKLQV66ZXPMMEA%2F20190920%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20190920T093121Z&X-Amz-SignedHeaders=host&X-Amz-Expires=3600&X-Amz-Signature=439ebd69a1b7e4c23e6d17891a491c94f832e0c82e4692dedb35a6cd1e624b62",
            "expireIn": "2019-09-20T10:31:21+00:00"
          }
        }');

        $downloadFile = $this->crowdin->reportArchive->downloadReportArchive(1, 12, '50fb3506-4127-4ba8-8296-f97dc7e3e0c3');

        $this->assertInstanceOf(DownloadFile::class, $downloadFile);
        $this->assertEquals('https://production-enterprise-importer.downloads.crowdin.com/992000002/2/14.xliff?response-content-disposition=attachment%3B%20filename%3D%22APP.xliff%22&X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAIGJKLQV66ZXPMMEA%2F20190920%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20190920T093121Z&X-Amz-SignedHeaders=host&X-Amz-Expires=3600&X-Amz-Signature=439ebd69a1b7e4c23e6d17891a491c94f832e0c82e4692dedb35a6cd1e624b62', $downloadFile->getUrl());
    }
}
