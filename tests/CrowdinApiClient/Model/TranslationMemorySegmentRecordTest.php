<?php

namespace CrowdinApiClient\Test\Model;

use CrowdinApiClient\Model\TranslationMemorySegmentRecord;
use PHPUnit\Framework\TestCase;

class TranslationMemorySegmentRecordTest extends TestCase
{
    /**
     * @var TranslationMemorySegmentRecord
     */
    public $record;

    /**
     * @var array
     */
    public $data = [
        'id' => 1,
        'languageId' => 'uk',
        'text' => 'Перекладений текст',
        'usageCount' => 13,
        'createdBy' => 1,
        'updatedBy' => 1,
        'createdAt' => '2019-09-16T13:48:04+00:00',
        'updatedAt' => '2019-09-16T13:48:04+00:00',
    ];

    public function testLoadData()
    {
        $this->record = new TranslationMemorySegmentRecord($this->data);
        $this->checkData();
    }

    public function testSetData()
    {
        $this->record = new TranslationMemorySegmentRecord();
        $this->record->setId($this->data['id']);
        $this->record->setLanguageId($this->data['languageId']);
        $this->record->setText($this->data['text']);
        $this->record->setUsageCount($this->data['usageCount']);
        $this->record->setCreatedBy($this->data['createdBy']);
        $this->record->setUpdatedBy($this->data['updatedBy']);
        $this->record->setCreatedAt($this->data['createdAt']);
        $this->record->setUpdatedAt($this->data['updatedAt']);

        $this->assertEquals($this->data['id'], $this->record->getId());
        $this->assertEquals($this->data['languageId'], $this->record->getLanguageId());
        $this->assertEquals($this->data['text'], $this->record->getText());
        $this->assertEquals($this->data['usageCount'], $this->record->getUsageCount());
        $this->assertEquals($this->data['createdBy'], $this->record->getCreatedBy());
        $this->assertEquals($this->data['updatedBy'], $this->record->getUpdatedBy());
        $this->assertEquals($this->data['createdAt'], $this->record->getCreatedAt());
        $this->assertEquals($this->data['updatedAt'], $this->record->getUpdatedAt());
    }

    public function checkData()
    {
        $this->assertEquals($this->data['id'], $this->record->getId());
        $this->assertEquals($this->data['languageId'], $this->record->getLanguageId());
        $this->assertEquals($this->data['text'], $this->record->getText());
        $this->assertEquals($this->data['usageCount'], $this->record->getUsageCount());
        $this->assertEquals($this->data['createdBy'], $this->record->getCreatedBy());
        $this->assertEquals($this->data['updatedBy'], $this->record->getUpdatedBy());
        $this->assertEquals($this->data['createdAt'], $this->record->getCreatedAt());
        $this->assertEquals($this->data['updatedAt'], $this->record->getUpdatedAt());
    }
}
