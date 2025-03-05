<?php

namespace CrowdinApiClient\Tests\Model\Enterprise;

use CrowdinApiClient\Model\Enterprise\Group;
use PHPUnit\Framework\TestCase;

class GroupTest extends TestCase
{
    /**
     * @var Group
     */
    public $group;

    /**
     * @var array
     */
    public $data = [
        'id' => 1,
        'name' => 'KB materials',
        'description' => 'KB localization materials',
        'parentId' => 2,
        'organizationId' => 200000299,
        'userId' => 6,
        'subgroupsCount' => 0,
        'projectsCount' => 1,
        'createdAt' => '2019-09-20T11:11:05+00:00',
        'updatedAt' => '2019-09-20T12:22:20+00:00',
    ];

    public function testLoadData(): void
    {
        $this->group = new Group($this->data);
        $this->checkData();
    }

    public function testSetData(): void
    {
        $this->group = new Group();
        $this->group->setName($this->data['name']);
        $this->group->setDescription($this->data['description']);
        $this->group->setParentId($this->data['parentId']);

        $this->assertEquals($this->data['name'], $this->group->getName());
        $this->assertEquals($this->data['description'], $this->group->getDescription());
        $this->assertEquals($this->data['parentId'], $this->group->getParentId());
    }

    public function checkData(): void
    {
        $this->assertEquals($this->data['id'], $this->group->getId());
        $this->assertEquals($this->data['name'], $this->group->getName());
        $this->assertEquals($this->data['description'], $this->group->getDescription());
        $this->assertEquals($this->data['parentId'], $this->group->getParentId());
        $this->assertEquals($this->data['organizationId'], $this->group->getOrganizationId());
        $this->assertEquals($this->data['userId'], $this->group->getUserId());
        $this->assertEquals($this->data['subgroupsCount'], $this->group->getSubgroupsCount());
        $this->assertEquals($this->data['projectsCount'], $this->group->getProjectsCount());
        $this->assertEquals($this->data['createdAt'], $this->group->getCreatedAt());
        $this->assertEquals($this->data['updatedAt'], $this->group->getUpdatedAt());
    }
}
