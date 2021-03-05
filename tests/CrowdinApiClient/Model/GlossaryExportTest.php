<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\GlossaryExport;
use PHPUnit\Framework\TestCase;

/**
 * Class GlossaryExportTest
 * @package Crowdin\Tests\Model
 */
class GlossaryExportTest extends TestCase
{
    /**
     * @var GlossaryExport
     */
    public $glossaryExport;

    /**
     * @var array
     */
    public $data = [
        'identifier' => '5ed2ce93-6d47-4402-9e66-516ca835cb20',
        'status' => 'created',
        'progress' => 0,
        'attributes' => [
                'format' => 'csv',
                'organizationId' => 200000299,
                'glossaryId' => 6,
            ],
        'createdAt' => '2019-09-23T07:06:43+00:00',
        'updatedAt' => '2019-09-23T07:06:43+00:00',
        'startedAt' => '2019-11-14T09:29:33Z',
        'finishedAt' => '2019-11-14T09:29:33Z',
    ];

    public function testLoadData()
    {
        $this->glossaryExport = new GlossaryExport($this->data);
        $this->checkData();
    }

    public function testSetData()
    {
        $this->glossaryExport = new GlossaryExport();

        $this->glossaryExport->setIdentifier($this->data['identifier']);
        $this->glossaryExport->setStatus($this->data['status']);
        $this->glossaryExport->setProgress($this->data['progress']);
        $this->glossaryExport->setAttributes($this->data['attributes']);
        $this->glossaryExport->setCreatedAt($this->data['createdAt']);
        $this->glossaryExport->setUpdatedAt($this->data['updatedAt']);
        $this->glossaryExport->setStartedAt($this->data['startedAt']);
        $this->glossaryExport->setFinishedAt($this->data['finishedAt']);
        $this->checkData();
    }

    public function checkData()
    {
        $this->assertEquals($this->data['identifier'], $this->glossaryExport->getIdentifier());
        $this->assertEquals($this->data['status'], $this->glossaryExport->getStatus());
        $this->assertEquals($this->data['progress'], $this->glossaryExport->getProgress());
        $this->assertEquals($this->data['attributes'], $this->glossaryExport->getAttributes());
        $this->assertEquals($this->data['createdAt'], $this->glossaryExport->getCreatedAt());
        $this->assertEquals($this->data['updatedAt'], $this->glossaryExport->getUpdatedAt());
        $this->assertEquals($this->data['startedAt'], $this->glossaryExport->getStartedAt());
        $this->assertEquals($this->data['finishedAt'], $this->glossaryExport->getFinishedAt());
    }
}
