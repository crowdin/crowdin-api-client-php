<?php


namespace Crowdin\Tests\Model;


use Crowdin\Model\GlossaryExport;
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
        'eta' => '1 second',
    ];

    public function setUp()
    {
        parent::setUp();
        $this->glossaryExport = new GlossaryExport($this->data);
    }

    public function testLoadData()
    {
        $this->assertEquals($this->data['identifier'], $this->glossaryExport->getIdentifier());
        $this->assertEquals($this->data['status'], $this->glossaryExport->getStatus());
        $this->assertEquals($this->data['progress'], $this->glossaryExport->getProgress());
        $this->assertEquals($this->data['attributes'], $this->glossaryExport->getAttributes());
        $this->assertEquals($this->data['createdAt'], $this->glossaryExport->getCreatedAt());
        $this->assertEquals($this->data['updatedAt'], $this->glossaryExport->getUpdatedAt());
        $this->assertEquals($this->data['startedAt'], $this->glossaryExport->getStartedAt());
        $this->assertEquals($this->data['finishedAt'], $this->glossaryExport->getFinishedAt());
        $this->assertEquals($this->data['eta'], $this->glossaryExport->getEta());
    }
}
