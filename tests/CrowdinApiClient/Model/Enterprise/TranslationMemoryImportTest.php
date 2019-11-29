<?php

namespace CrowdinApiClient\Tests\Model\Enterprise;

use CrowdinApiClient\Model\Enterprise\TranslationMemoryImport;
use PHPUnit\Framework\TestCase;

class TranslationMemoryImportTest extends TestCase
{
    /**
     * @var TranslationMemoryImport
     */
    public $translationMemoryImport;

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
        $this->translationMemoryImport = new TranslationMemoryImport($this->data);
        $this->checkData();
    }

    public function testSetData()
    {
        $this->translationMemoryImport = new TranslationMemoryImport();

        $this->translationMemoryImport->setIdentifier($this->data['identifier']);
        $this->translationMemoryImport->setStatus($this->data['status']);
        $this->translationMemoryImport->setProgress($this->data['progress']);
        $this->translationMemoryImport->setAttributes($this->data['attributes']);
        $this->translationMemoryImport->setCreatedAt($this->data['createdAt']);
        $this->translationMemoryImport->setUpdatedAt($this->data['updatedAt']);
        $this->translationMemoryImport->setStartedAt($this->data['startedAt']);
        $this->translationMemoryImport->setFinishedAt($this->data['finishedAt']);
        $this->translationMemoryImport->setEta($this->data['eta']);
        $this->checkData();
    }

    public function checkData()
    {
        $this->assertEquals($this->data['identifier'], $this->translationMemoryImport->getIdentifier());
        $this->assertEquals($this->data['status'], $this->translationMemoryImport->getStatus());
        $this->assertEquals($this->data['progress'], $this->translationMemoryImport->getProgress());
        $this->assertEquals($this->data['attributes'], $this->translationMemoryImport->getAttributes());
        $this->assertEquals($this->data['createdAt'], $this->translationMemoryImport->getCreatedAt());
        $this->assertEquals($this->data['updatedAt'], $this->translationMemoryImport->getUpdatedAt());
        $this->assertEquals($this->data['startedAt'], $this->translationMemoryImport->getStartedAt());
        $this->assertEquals($this->data['finishedAt'], $this->translationMemoryImport->getFinishedAt());
        $this->assertEquals($this->data['eta'], $this->translationMemoryImport->getEta());
    }
}
