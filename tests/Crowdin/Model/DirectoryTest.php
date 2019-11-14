<?php

namespace Crowdin\Tests\Model;

use Crowdin\Model\Directory;
use PHPUnit\Framework\TestCase;

/**
 * Class DirectoryTest
 * @package Crowdin\Tests\Model
 */
class DirectoryTest extends TestCase
{
    /**
     * @var array
     */
    public $data = [
        'id' => 4,
        'projectId' => 2,
        'branchId' => 34,
        'parentId' => 0,
        'name' => 'main',
        'title' => '<Description materials>',
        'exportPattern' => '/localization/%locale%/%file_name%',
        'priority' => 'normal',
        'createdAt' => '2019-09-19T14:14:00+00:00',
        'updatedAt' => '2019-09-19T14:14:00+00:00',
    ];

    /**
     * @var Directory
     */
    public $directory;

    public function setUp()
    {
        parent::setUp();
        $this->directory = new Directory($this->data);
    }

    public function testLoadData()
    {
        $this->assertEquals($this->data['id'], $this->directory->getId());
        $this->assertEquals($this->data['projectId'], $this->directory->getProjectId());
        $this->assertEquals($this->data['branchId'], $this->directory->getBranchId());
        $this->assertEquals($this->data['parentId'], $this->directory->getParentId());
        $this->assertEquals($this->data['name'], $this->directory->getName());
        $this->assertEquals($this->data['title'], $this->directory->getTitle());
        $this->assertEquals($this->data['exportPattern'], $this->directory->getExportPattern());
        $this->assertEquals($this->data['priority'], $this->directory->getPriority());
        $this->assertEquals($this->data['createdAt'], $this->directory->getCreatedAt());
        $this->assertEquals($this->data['updatedAt'], $this->directory->getUpdatedAt());
    }
}
