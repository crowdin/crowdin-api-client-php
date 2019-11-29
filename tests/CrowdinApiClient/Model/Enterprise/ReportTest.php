<?php

namespace CrowdinApiClient\Tests\Model\Enterprise;

use CrowdinApiClient\Model\Enterprise\Report;
use PHPUnit\Framework\TestCase;

/**
 * Class ReportTest
 * @package Crowdin\Tests\Model
 */
class ReportTest extends TestCase
{
    /**
     * @var Report
     */
    public $report;

    /**
     * @var array
     */
    public $data = [
        'identifier' => '50fb3506-4127-4ba8-8296-f97dc7e3e0c3',
        'status' => 'finished',
        'progress' => 100,
        'attributes' =>
            [
                'organizationId' => 10,
                'projectId' => 124,
                'format' => 'xlsx',
                'reportName' => 'costs-estimation',
                'schema' =>
                    [
                    ],
            ],
        'createdAt' => '2019-09-23T11:26:54+00:00',
        'updatedAt' => '2019-09-23T11:26:54+00:00',
        'startedAt' => '2019-09-23T11:26:54+00:00',
        'finishedAt' => '2019-09-23T11:26:54+00:00',
        'eta' => '1 second',
    ];

    /**
     * @test
     */
    public function testLoadData()
    {
        $this->report = new Report($this->data);
        $this->checkData();
    }
    /**
     * @test
     */
    public function testSetData()
    {
        $this->report = new Report();
        $this->report->setIdentifier($this->data['identifier']);
        $this->report->setStatus($this->data['status']);
        $this->report->setProgress($this->data['progress']);
        $this->report->setAttributes($this->data['attributes']);
        $this->report->setCreatedAt($this->data['createdAt']);
        $this->report->setUpdatedAt($this->data['updatedAt']);
        $this->report->setStartedAt($this->data['startedAt']);
        $this->report->setFinishedAt($this->data['finishedAt']);
        $this->report->setEta($this->data['eta']);
        $this->checkData();
    }

    public function checkData()
    {
        $this->assertEquals($this->data['identifier'], $this->report->getIdentifier());
        $this->assertEquals($this->data['status'], $this->report->getStatus());
        $this->assertEquals($this->data['progress'], $this->report->getProgress());
        $this->assertEquals($this->data['attributes'], $this->report->getAttributes());
        $this->assertEquals($this->data['createdAt'], $this->report->getCreatedAt());
        $this->assertEquals($this->data['updatedAt'], $this->report->getUpdatedAt());
        $this->assertEquals($this->data['startedAt'], $this->report->getStartedAt());
        $this->assertEquals($this->data['finishedAt'], $this->report->getFinishedAt());
        $this->assertEquals($this->data['eta'], $this->report->getEta());
    }
}
