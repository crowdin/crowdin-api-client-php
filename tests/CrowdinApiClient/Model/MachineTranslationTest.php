<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\MachineTranslation;
use PHPUnit\Framework\TestCase;

class MachineTranslationTest extends TestCase
{
    public $machineTranslation;

    public $data = [
        'sourceLanguageId' => 'en',
        'targetLanguageId' => 'de',
        'strings' => [
            'Welcome!',
            'Save as...',
            'View',
            'About...'
        ],
        'translations' => [
            'Herzlich willkommen!',
            'Speichern als...',
            'Aussicht',
            'Etwa...'
        ],
    ];

    public function testLoadData()
    {
        $this->machineTranslation = new MachineTranslation($this->data);
        $this->checkData();
    }

    public function testSetData()
    {
        $this->machineTranslation = new MachineTranslation();
        $this->machineTranslation->setSourceLanguageId($this->data['sourceLanguageId']);
        $this->machineTranslation->setTargetLanguageId($this->data['targetLanguageId']);
        $this->machineTranslation->setStrings($this->data['strings']);
        $this->machineTranslation->setTranslations($this->data['translations']);

        $this->assertEquals($this->data['sourceLanguageId'], $this->machineTranslation->getSourceLanguageId());
        $this->assertEquals($this->data['targetLanguageId'], $this->machineTranslation->getTargetLanguageId());
        $this->assertEquals($this->data['strings'], $this->machineTranslation->getStrings());
        $this->assertEquals($this->data['translations'], $this->machineTranslation->getTranslations());
    }

    public function checkData()
    {
        $this->assertEquals($this->data['sourceLanguageId'], $this->machineTranslation->getSourceLanguageId());
        $this->assertEquals($this->data['targetLanguageId'], $this->machineTranslation->getTargetLanguageId());
        $this->assertEquals($this->data['strings'], $this->machineTranslation->getStrings());
        $this->assertEquals($this->data['translations'], $this->machineTranslation->getTranslations());
    }
}
