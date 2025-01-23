<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\TaskSettingsTemplate;
use PHPUnit\Framework\TestCase;

class TaskSettingsTemplateTest extends TestCase
{
    /**
     * @var TaskSettingsTemplate
     */
    public $taskSettingsTemplate;

    public $data = [
        'id' => 1,
        'name' => 'Default template',
        'config' => [
            'languages' => [
                [
                    'languageId' => 'uk',
                    'userIds' => [
                        1,
                    ],
                ],
            ],
        ],
        'createdAt' => '2019-09-23T09:35:31+00:00',
        'updatedAt' => '2020-09-23T09:35:31+00:00',
    ];

    public function testLoadData(): void
    {
        $this->taskSettingsTemplate = new TaskSettingsTemplate($this->data);
        $this->checkData();
    }

    public function testSetData(): void
    {
        $this->taskSettingsTemplate = new TaskSettingsTemplate();
        $this->taskSettingsTemplate->setName($this->data['name']);
        $this->taskSettingsTemplate->setConfig($this->data['config']);

        $this->assertEquals($this->data['name'], $this->taskSettingsTemplate->getName());
        $this->assertEquals($this->data['config'], $this->taskSettingsTemplate->getConfig());
    }

    public function checkData(): void
    {
        $this->assertEquals($this->data['id'], $this->taskSettingsTemplate->getId());
        $this->assertEquals($this->data['config'], $this->taskSettingsTemplate->getConfig());
        $this->assertEquals($this->data['createdAt'], $this->taskSettingsTemplate->getCreatedAt());
        $this->assertEquals($this->data['updatedAt'], $this->taskSettingsTemplate->getUpdatedAt());
    }

}
