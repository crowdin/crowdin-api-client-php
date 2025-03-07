<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\TranslationMemory;
use PHPUnit\Framework\TestCase;

class TranslationMemoryTest extends TestCase
{
    public $translationMemory;

    public $data = [
        'id' => 4,
        'groupId' => 2,
        'name' => 'Knowledge Base\'s TM',
        'languageIds' =>
        [
          0 => 'el',
        ],
        'segmentsCount' => 21,
        'defaultProjectIds' => [0],
        'projectIds' =>
        [
          0 => 2,
        ],
        'createdAt' => '2019-09-23T09:04:29+00:00'
    ];

    public function testLoadData()
    {
        $this->translationMemory = new TranslationMemory($this->data);
        $this->checkData();
    }

    public function testSetData()
    {
        $this->translationMemory = new TranslationMemory();
        $this->translationMemory->setName($this->data['name']);
        $this->translationMemory->setCreatedAt($this->data['createdAt']);

        $this->assertEquals($this->data['name'], $this->translationMemory->getName());
        $this->assertEquals($this->data['createdAt'], $this->translationMemory->getCreatedAt());
    }

    public function checkData()
    {
        $this->assertEquals($this->data['id'], $this->translationMemory->getId());
        $this->assertEquals($this->data['groupId'], $this->translationMemory->getGroupId());
        $this->assertEquals($this->data['name'], $this->translationMemory->getName());
        $this->assertEquals($this->data['languageIds'], $this->translationMemory->getLanguageIds());
        $this->assertEquals($this->data['segmentsCount'], $this->translationMemory->getSegmentsCount());
        $this->assertEquals($this->data['defaultProjectIds'], $this->translationMemory->getDefaultProjectIds());
        $this->assertEquals($this->data['projectIds'], $this->translationMemory->getProjectIds());
        $this->assertEquals($this->data['createdAt'], $this->translationMemory->getCreatedAt());
    }
}
