<?php

namespace CrowdinApiClient\Tests\Model\Enterprise;

use CrowdinApiClient\Model\Enterprise\Field;
use PHPUnit\Framework\TestCase;

class FieldTest extends TestCase
{
    public $data = [
        'id' => 1,
        'name' => 'Priority',
        'slug' => 'priority',
        'description' => 'Task priority level',
        'type' => 'radiobuttons',
        'entities' => ['task'],
        'config' => [
            'options' => [
                ['label' => 'Low', 'value' => 'low'],
                ['label' => 'High', 'value' => 'high'],
            ],
            'locations' => [
                ['place' => 'projectTaskDetails'],
            ],
        ],
        'createdAt' => '2024-01-15T10:00:00+00:00',
        'updatedAt' => '2024-01-15T10:00:00+00:00',
    ];

    public function testLoadData(): void
    {
        $field = new Field($this->data);
        $this->assertEquals($this->data['id'], $field->getId());
        $this->assertEquals($this->data['name'], $field->getName());
        $this->assertEquals($this->data['slug'], $field->getSlug());
        $this->assertEquals($this->data['description'], $field->getDescription());
        $this->assertEquals($this->data['type'], $field->getType());
        $this->assertEquals($this->data['entities'], $field->getEntities());
        $this->assertEquals($this->data['config'], $field->getConfig());
        $this->assertEquals($this->data['createdAt'], $field->getCreatedAt());
        $this->assertEquals($this->data['updatedAt'], $field->getUpdatedAt());
    }

    public function testSetData(): void
    {
        $field = new Field();
        $field->setName($this->data['name']);
        $field->setDescription($this->data['description']);
        $field->setEntities($this->data['entities']);
        $field->setConfig($this->data['config']);

        $this->assertEquals($this->data['name'], $field->getName());
        $this->assertEquals($this->data['description'], $field->getDescription());
        $this->assertEquals($this->data['entities'], $field->getEntities());
        $this->assertEquals($this->data['config'], $field->getConfig());
    }
}
