<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\GlossaryImport;
use PHPUnit\Framework\TestCase;

class GlossaryImportImportTest extends TestCase
{
    /**
     * @var GlossaryImport
     */
    public $glossaryImport;

    public $data = [
        'identifier' => '50fb3506-4127-4ba8-8296-f97dc7e3e0c3',
        'status' => 'finished',
        'progress' => 100,
        'attributes' =>
            [
                'sourceLanguageId' => 'en',
                'targetLanguageId' => 'de',
                'format' => 'csv',
                'tmId' => 4,
                'userId' => 6,
            ],
        'createdAt' => '2019-09-23T11:26:54+00:00',
        'updatedAt' => '2019-09-23T11:26:54+00:00',
        'startedAt' => '2019-09-23T11:26:54+00:00',
        'finishedAt' => '2019-09-23T11:26:54+00:00',
        'eta' => '1 second',
    ];

    public function testLoadData()
    {
        $this->glossaryImport = new GlossaryImport($this->data);
        $this->checkData();
    }

    public function checkData()
    {
        $this->assertEquals($this->data['identifier'], $this->glossaryImport->getIdentifier());
        $this->assertEquals($this->data['status'], $this->glossaryImport->getStatus());
        $this->assertEquals($this->data['progress'], $this->glossaryImport->getProgress());
        $this->assertEquals($this->data['attributes'], $this->glossaryImport->getAttributes());
        $this->assertEquals($this->data['createdAt'], $this->glossaryImport->getCreatedAt());
        $this->assertEquals($this->data['updatedAt'], $this->glossaryImport->getUpdatedAt());
        $this->assertEquals($this->data['startedAt'], $this->glossaryImport->getStartedAt());
        $this->assertEquals($this->data['finishedAt'], $this->glossaryImport->getFinishedAt());
        $this->assertEquals($this->data['eta'], $this->glossaryImport->getEta());
    }
}
