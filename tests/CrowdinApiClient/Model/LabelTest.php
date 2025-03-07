<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\Label;
use PHPUnit\Framework\TestCase;

class LabelTest extends TestCase
{
    /**
     * @var array
     */
    public $data = [
        'id' => 4,
        'title' => 'main',
    ];

    /**
     * @var Label
     */
    public $label;

    public function testLoadData()
    {
        $this->label = new Label($this->data);
        $this->checkData();
    }

    public function testSetData()
    {
        $this->label = new Label();
        $this->label->setTitle($this->data['title']);

        $this->assertEquals($this->data['title'], $this->label->getTitle());
    }

    public function checkData()
    {
        $this->assertEquals($this->data['id'], $this->label->getId());
        $this->assertEquals($this->data['title'], $this->label->getTitle());
    }
}
