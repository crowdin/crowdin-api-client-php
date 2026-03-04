<?php

namespace CrowdinApiClient\Tests\Api\Enterprise;

use CrowdinApiClient\Model\Enterprise\Field;
use CrowdinApiClient\ModelCollection;

class FieldApiTest extends AbstractTestApi
{
    protected $fieldData = [
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

    public function testList(): void
    {
        $this->mockRequest([
            'uri' => 'https://organization_domain.crowdin.com/api/v2/fields',
            'method' => 'get',
            'response' => json_encode([
                'data' => [
                    ['data' => $this->fieldData],
                ],
                'pagination' => [
                    ['offset' => 0, 'limit' => 25],
                ],
            ]),
        ]);

        $fields = $this->crowdin->field->list();

        $this->assertInstanceOf(ModelCollection::class, $fields);
        $this->assertCount(1, $fields);
        $this->assertInstanceOf(Field::class, $fields[0]);
        $this->assertEquals(1, $fields[0]->getId());
        $this->assertEquals('Priority', $fields[0]->getName());
        $this->assertEquals('priority', $fields[0]->getSlug());
        $this->assertEquals('radiobuttons', $fields[0]->getType());
    }

    public function testCreate(): void
    {
        $this->mockRequest([
            'uri' => 'https://organization_domain.crowdin.com/api/v2/fields',
            'method' => 'post',
            'response' => json_encode(['data' => $this->fieldData]),
        ]);

        $field = $this->crowdin->field->create([
            'name' => 'Priority',
            'slug' => 'priority',
            'type' => 'radiobuttons',
            'entities' => ['task'],
            'description' => 'Task priority level',
            'config' => [
                'options' => [
                    ['label' => 'Low', 'value' => 'low'],
                    ['label' => 'High', 'value' => 'high'],
                ],
                'locations' => [
                    ['place' => 'projectTaskDetails'],
                ],
            ],
        ]);

        $this->assertInstanceOf(Field::class, $field);
        $this->assertEquals(1, $field->getId());
        $this->assertEquals('Priority', $field->getName());
        $this->assertEquals('priority', $field->getSlug());
    }

    public function testGetAndUpdate(): void
    {
        $this->mockRequestGet('/fields/1', json_encode(['data' => $this->fieldData]));

        $field = $this->crowdin->field->get(1);

        $this->assertInstanceOf(Field::class, $field);
        $this->assertEquals(1, $field->getId());
        $this->assertEquals('Priority', $field->getName());

        $field->setName('Updated Priority');

        $updatedData = array_merge($this->fieldData, ['name' => 'Updated Priority']);
        $this->mockRequestPatch('/fields/1', json_encode(['data' => $updatedData]));

        $this->crowdin->field->update($field);

        $this->assertInstanceOf(Field::class, $field);
        $this->assertEquals(1, $field->getId());
        $this->assertEquals('Updated Priority', $field->getName());
    }

    public function testDelete(): void
    {
        $this->mockRequestDelete('/fields/1');

        $this->crowdin->field->delete(1);
    }
}
