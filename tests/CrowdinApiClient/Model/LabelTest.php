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

    public function testLoadAdditionalFields(): void
    {
        $model = new Label([
            'isShared' => true,
            'isSystem' => true,
        ]);

        $this->assertSame(true, $model->isShared());
        $this->assertSame(true, $model->isSystem());
    }

    public function testAdditionalFieldsWhenMissing(): void
    {
        $model = new Label([]);

        $this->assertNull($model->isShared());
        $this->assertNull($model->isSystem());
    }
}
