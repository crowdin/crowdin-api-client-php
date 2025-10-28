<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\FileReference;

class FileReferenceTest extends \PHPUnit\Framework\TestCase
{
    public function testFileReferenceModel()
    {
        $data = [
            'id' => 1,
            'projectId' => 2,
            'fileId' => 44,
            'name' => 'Asset Reference',
            'type' => 'image',
            'url' => 'https://cdn.example.com/assets/image.png',
            'createdAt' => '2019-09-19T15:10:43+00:00',
            'updatedAt' => '2019-09-19T15:10:46+00:00'
        ];

        $fileReference = new FileReference($data);

        $this->assertEquals(1, $fileReference->getId());
        $this->assertEquals(2, $fileReference->getProjectId());
        $this->assertEquals(44, $fileReference->getFileId());
        $this->assertEquals('Asset Reference', $fileReference->getName());
        $this->assertEquals('image', $fileReference->getType());
        $this->assertEquals('https://cdn.example.com/assets/image.png', $fileReference->getUrl());
        $this->assertEquals('2019-09-19T15:10:43+00:00', $fileReference->getCreatedAt());
        $this->assertEquals('2019-09-19T15:10:46+00:00', $fileReference->getUpdatedAt());
    }

    public function testFileReferenceSetters()
    {
        $fileReference = new FileReference();

        $fileReference->setName('New Name');
        $fileReference->setType('document');
        $fileReference->setUrl('https://docs.example.com/assets/new.pdf');

        $this->assertEquals('New Name', $fileReference->getName());
        $this->assertEquals('document', $fileReference->getType());
        $this->assertEquals('https://docs.example.com/assets/new.pdf', $fileReference->getUrl());
    }
}
