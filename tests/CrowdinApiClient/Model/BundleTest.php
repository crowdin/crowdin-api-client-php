<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\Bundle;
use PHPUnit\Framework\TestCase;

/**
 * Class BundleTest
 * @package Crowdin\Tests\Model
 */
class BundleTest extends TestCase
{
    /**
     * @var array
     */
    public $data = [
        'id' => 34,
        'name' => 'Resx bundle',
        'format' => 'crowdin-resx',
        'sourcePatterns' => ['/master/'],
        'ignorePatterns' => ['/master/environments/'],
        'exportPattern' => 'strings-%two_letters_code%.resx',
        'labelIds' => [0],
        'createdAt' => '2019-09-16T13:48:04+00:00',
        'updatedAt' => '2019-09-19T13:25:27+00:00',
    ];

    /**
     * @var Bundle
     */
    public $bundle;

    public function testLoadData()
    {
        $this->bundle = new Bundle($this->data);
        $this->checkData();
    }

    /**
     * @depends testLoadData
     */
    public function testSetData()
    {
        $this->bundle = new Bundle();
        $this->bundle->setName($this->data['name']);
        $this->bundle->setFormat($this->data['format']);
        $this->bundle->setExportPattern($this->data['exportPattern']);
        $this->bundle->setIgnorePatterns($this->data['ignorePatterns']);
        $this->bundle->setSourcePatterns($this->data['sourcePatterns']);
        $this->bundle->setLabelIds($this->data['labelIds']);

        $this->assertEquals($this->data['name'], $this->bundle->getName());
        $this->assertEquals($this->data['format'], $this->bundle->getFormat());
        $this->assertEquals($this->data['exportPattern'], $this->bundle->getExportPattern());
        $this->assertEquals($this->data['ignorePatterns'], $this->bundle->getIgnorePatterns());
        $this->assertEquals($this->data['sourcePatterns'], $this->bundle->getSourcePatterns());
        $this->assertEquals($this->data['labelIds'], $this->bundle->getLabelIds());
    }

    public function checkData()
    {
        $this->assertEquals($this->data['id'], $this->bundle->getId());
        $this->assertEquals($this->data['name'], $this->bundle->getName());
        $this->assertEquals($this->data['format'], $this->bundle->getFormat());
        $this->assertEquals($this->data['exportPattern'], $this->bundle->getExportPattern());
        $this->assertEquals($this->data['ignorePatterns'], $this->bundle->getIgnorePatterns());
        $this->assertEquals($this->data['sourcePatterns'], $this->bundle->getSourcePatterns());
        $this->assertEquals($this->data['labelIds'], $this->bundle->getLabelIds());
        $this->assertEquals($this->data['createdAt'], $this->bundle->getCreatedAt());
        $this->assertEquals($this->data['updatedAt'], $this->bundle->getUpdatedAt());
    }
}
