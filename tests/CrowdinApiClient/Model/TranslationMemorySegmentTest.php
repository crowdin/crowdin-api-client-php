<?php

namespace CrowdinApiClient\Test\Model;

use CrowdinApiClient\Model\TranslationMemorySegment;
use CrowdinApiClient\Model\TranslationMemorySegmentRecord;
use PHPUnit\Framework\TestCase;

class TranslationMemorySegmentTest extends TestCase
{
    /**
     * @var TranslationMemorySegment
     */
    public $segment;

    /**
     * @var array
     */
    public $data = [
        'id' => 4,
        'records' => [
            [
                'id' => 1,
                'languageId' => 'uk',
                'text' => 'Перекладений текст',
                'usageCount' => 13,
                'createdBy' => 1,
                'updatedBy' => 1,
                'createdAt' => '2019-09-16T13:48:04+00:00',
                'updatedAt' => '2019-09-16T13:48:04+00:00',
            ],
        ],
    ];

    public function testLoadData()
    {
        $this->segment = new TranslationMemorySegment($this->data);
        $this->checkData();
    }

    public function testSetData()
    {
        $this->segment = new TranslationMemorySegment();
        $this->segment->setId($this->data['id']);

        $record = new TranslationMemorySegmentRecord($this->data['records'][0]);
        $this->segment->setRecords([$record]);

        $this->assertEquals($this->data['id'], $this->segment->getId());
        $this->assertIsArray($this->segment->getRecords());
        $this->assertInstanceOf(TranslationMemorySegmentRecord::class, $this->segment->getRecords()[0]);
        $this->assertEquals($this->data['records'][0]['id'], $this->segment->getRecords()[0]->getId());
    }

    public function checkData()
    {
        $this->assertEquals($this->data['id'], $this->segment->getId());
        $this->assertIsArray($this->segment->getRecords());
        $this->assertInstanceOf(TranslationMemorySegmentRecord::class, $this->segment->getRecords()[0]);
        $this->assertEquals($this->data['records'][0]['id'], $this->segment->getRecords()[0]->getId());
        $this->assertEquals($this->data['records'][0]['languageId'], $this->segment->getRecords()[0]->getLanguageId());
        $this->assertEquals($this->data['records'][0]['text'], $this->segment->getRecords()[0]->getText());
        $this->assertEquals($this->data['records'][0]['usageCount'], $this->segment->getRecords()[0]->getUsageCount());
        $this->assertEquals($this->data['records'][0]['createdBy'], $this->segment->getRecords()[0]->getCreatedBy());
        $this->assertEquals($this->data['records'][0]['updatedBy'], $this->segment->getRecords()[0]->getUpdatedBy());
        $this->assertEquals($this->data['records'][0]['createdAt'], $this->segment->getRecords()[0]->getCreatedAt());
        $this->assertEquals($this->data['records'][0]['updatedAt'], $this->segment->getRecords()[0]->getUpdatedAt());
    }
}
