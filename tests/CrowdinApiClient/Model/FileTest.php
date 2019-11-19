<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\File;
use PHPUnit\Framework\TestCase;

/**
 * Class FileTest
 * @package Crowdin\Tests\Model
 */
class FileTest extends TestCase
{
    /**
     * @var File
     */
    public $file;

    /**
     * @var array
     */
    public $data = [
        'id' => 44,
        'projectId' => 2,
        'branchId' => 34,
        'directoryId' => 4,
        'languageId' => 'en',
        'name' => 'umbrella_app.xliff',
        'title' => 'source_app_info',
        'type' => 'xliff',
        'revision' => 1,
        'status' => 'active',
        'priority' => 'normal',
        'attributes' => [
            'mimeType' => 'application/xml',
            'fileSize' => 261433,
        ],
        'exportPattern' => 'string',
        'createdAt' => '2019-09-19T15:10:43+00:00',
        'updatedAt' => '2019-09-19T15:10:46+00:00',
    ];

    public function testLoadData()
    {
        $this->file = new File($this->data);
        $this->checkData();
    }

    public function testSetData()
    {
        $this->file = new File();
        $this->file->setId($this->data['id']);
        $this->file->setProjectId($this->data['projectId']);
        $this->file->setBranchId($this->data['branchId']);
        $this->file->setDirectoryId($this->data['directoryId']);
        $this->file->setLanguageId($this->data['languageId']);
        $this->file->setName($this->data['name']);
        $this->file->setTitle($this->data['title']);
        $this->file->setType($this->data['type']);
        $this->file->setRevision($this->data['revision']);
        $this->file->setStatus($this->data['status']);
        $this->file->setPriority($this->data['priority']);
        $this->file->setAttributes($this->data['attributes']);
        $this->file->setExportPattern($this->data['exportPattern']);
        $this->file->setCreatedAt($this->data['createdAt']);
        $this->file->setUpdatedAt($this->data['updatedAt']);

        $this->checkData();
    }

    public function checkData()
    {
        $this->assertEquals($this->data['id'], $this->file->getId());
        $this->assertEquals($this->data['projectId'], $this->file->getProjectId());
        $this->assertEquals($this->data['branchId'], $this->file->getBranchId());
        $this->assertEquals($this->data['directoryId'], $this->file->getDirectoryId());
        $this->assertEquals($this->data['languageId'], $this->file->getLanguageId());
        $this->assertEquals($this->data['name'], $this->file->getName());
        $this->assertEquals($this->data['title'], $this->file->getTitle());
        $this->assertEquals($this->data['type'], $this->file->getType());
        $this->assertEquals($this->data['revision'], $this->file->getRevision());
        $this->assertEquals($this->data['status'], $this->file->getStatus());
        $this->assertEquals($this->data['priority'], $this->file->getPriority());
        $this->assertEquals($this->data['attributes'], $this->file->getAttributes());
        $this->assertEquals($this->data['exportPattern'], $this->file->getExportPattern());
        $this->assertEquals($this->data['createdAt'], $this->file->getCreatedAt());
        $this->assertEquals($this->data['updatedAt'], $this->file->getUpdatedAt());
    }
}
