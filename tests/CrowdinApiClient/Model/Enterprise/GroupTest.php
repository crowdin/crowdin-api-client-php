<?php

namespace CrowdinApiClient\Tests\Model\Enterprise;

use CrowdinApiClient\Model\Enterprise\Group;
use PHPUnit\Framework\TestCase;

class GroupTest extends TestCase
{
    public $data = [
        'id' => 1,
        'name' => 'KB materials',
        'description' => 'KB localization materials',
        'parentId' => 2,
        'organizationId' => 200000299,
        'userId' => 6,
        'subgroupsCount' => 0,
        'projectsCount' => 1,
        'webUrl' => 'https://example.crowdin.com/groups/1',
        'savingsReportSettingsTemplateId' => 10,
        'createdAt' => '2019-09-20T11:11:05+00:00',
        'updatedAt' => '2019-09-20T12:22:20+00:00',
    ];

    public function testLoadData(): void
    {
        $group = new Group($this->data);
        $this->assertEquals($this->data['id'], $group->getId());
        $this->assertEquals($this->data['name'], $group->getName());
        $this->assertEquals($this->data['description'], $group->getDescription());
        $this->assertEquals($this->data['parentId'], $group->getParentId());
        $this->assertEquals($this->data['organizationId'], $group->getOrganizationId());
        $this->assertEquals($this->data['userId'], $group->getUserId());
        $this->assertEquals($this->data['subgroupsCount'], $group->getSubgroupsCount());
        $this->assertEquals($this->data['projectsCount'], $group->getProjectsCount());
        $this->assertEquals($this->data['webUrl'], $group->getWebUrl());
        $this->assertEquals($this->data['savingsReportSettingsTemplateId'], $group->getSavingsReportSettingsTemplateId());
        $this->assertEquals($this->data['createdAt'], $group->getCreatedAt());
        $this->assertEquals($this->data['updatedAt'], $group->getUpdatedAt());
    }

    public function testSetData(): void
    {
        $group = new Group();
        $group->setName($this->data['name']);
        $group->setDescription($this->data['description']);
        $group->setParentId($this->data['parentId']);

        $this->assertEquals($this->data['name'], $group->getName());
        $this->assertEquals($this->data['description'], $group->getDescription());
        $this->assertEquals($this->data['parentId'], $group->getParentId());
    }
}
