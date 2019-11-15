<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\Tag;
use PHPUnit\Framework\TestCase;

class TagTest extends TestCase
{
    public $tag;

    public $data = [
        'id' => 98,
        'screenshotId' => 2,
        'stringId' => 2822,
        'position' =>
            [
                'x' => 474,
                'y' => 147,
                'width' => 490,
                'height' => 99,
            ],
        'createdAt' => '2019-09-23T09:35:31+00:00',
    ];

    public function setUp()
    {
        parent::setUp();
        $this->tag = new Tag($this->data);
    }

    public function testLoadData()
    {
        $this->assertEquals($this->data['id'], $this->tag->getId());
        $this->assertEquals($this->data['screenshotId'], $this->tag->getScreenshotId());
        $this->assertEquals($this->data['stringId'], $this->tag->getStringId());
        $this->assertEquals($this->data['position'], $this->tag->getPosition());
        $this->assertEquals($this->data['createdAt'], $this->tag->getCreatedAt());
    }
}
