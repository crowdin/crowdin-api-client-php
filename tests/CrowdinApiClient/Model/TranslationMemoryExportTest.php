<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\TranslationMemoryExport;
use PHPUnit\Framework\TestCase;

class TranslationMemoryExportTest extends TestCase
{
    public $translationMemoryExport;

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
    ];

    public function testLoadData()
    {
        $this->translationMemoryExport = new TranslationMemoryExport($this->data);
        $this->checkData();
    }

    public function testSetData()
    {
        $this->translationMemoryExport = new TranslationMemoryExport();

        $this->translationMemoryExport->setIdentifier($this->data['identifier']);
        $this->translationMemoryExport->setStatus($this->data['status']);
        $this->translationMemoryExport->setProgress($this->data['progress']);
        $this->translationMemoryExport->setAttributes($this->data['attributes']);
        $this->translationMemoryExport->setCreatedAt($this->data['createdAt']);
        $this->translationMemoryExport->setUpdatedAt($this->data['updatedAt']);
        $this->translationMemoryExport->setStartedAt($this->data['startedAt']);
        $this->translationMemoryExport->setFinishedAt($this->data['finishedAt']);
        $this->checkData();
    }

    public function checkData()
    {
        $this->assertEquals($this->data['identifier'], $this->translationMemoryExport->getIdentifier());
        $this->assertEquals($this->data['status'], $this->translationMemoryExport->getStatus());
        $this->assertEquals($this->data['progress'], $this->translationMemoryExport->getProgress());
        $this->assertEquals($this->data['attributes'], $this->translationMemoryExport->getAttributes());
        $this->assertEquals($this->data['createdAt'], $this->translationMemoryExport->getCreatedAt());
        $this->assertEquals($this->data['updatedAt'], $this->translationMemoryExport->getUpdatedAt());
        $this->assertEquals($this->data['startedAt'], $this->translationMemoryExport->getStartedAt());
        $this->assertEquals($this->data['finishedAt'], $this->translationMemoryExport->getFinishedAt());
    }
}
