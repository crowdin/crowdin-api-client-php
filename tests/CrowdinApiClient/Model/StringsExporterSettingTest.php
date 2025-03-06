<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\StringsExporterSetting;
use PHPUnit\Framework\TestCase;

class StringsExporterSettingTest extends TestCase
{
    /**
     * @var array
     */
    public $data = [
        "id" => 2,
        "format" => "android"
    ];

    /**
     * @var StringsExporterSetting
     */
    public $stringExporterSetting;

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     */
    public function testLoadData()
    {
        $this->stringExporterSetting = new StringsExporterSetting($this->data);
        $this->checkData();
    }

    /**
     * @depends testLoadData
     */
    public function testSetData()
    {
        $this->stringExporterSetting = new StringsExporterSetting();
        $this->stringExporterSetting->setId($this->data['id']);
        $this->stringExporterSetting->setFormat($this->data['format']);
        $this->checkData();
    }

    public function checkData()
    {
        $this->assertEquals($this->data['id'], $this->stringExporterSetting->getId());
        $this->assertEquals($this->data['format'], $this->stringExporterSetting->getFormat());
    }
}
