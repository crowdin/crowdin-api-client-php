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
        'defaultProjectId' => 0,
        'projectIds' =>
        [
          0 => 2,
        ],
    ];

    public function setUp()
    {
        parent::setUp();
        $this->translationMemory = new TranslationMemory($this->data);
    }

    public function testLoadData()
    {
        $this->assertEquals($this->data['id'], $this->translationMemory->getId());
        $this->assertEquals($this->data['groupId'], $this->translationMemory->getGroupId());
        $this->assertEquals($this->data['name'], $this->translationMemory->getName());
        $this->assertEquals($this->data['languageIds'], $this->translationMemory->getLanguageIds());
        $this->assertEquals($this->data['segmentsCount'], $this->translationMemory->getSegmentsCount());
        $this->assertEquals($this->data['defaultProjectId'], $this->translationMemory->getDefaultProjectId());
        $this->assertEquals($this->data['projectIds'], $this->translationMemory->getProjectIds());
    }
}
