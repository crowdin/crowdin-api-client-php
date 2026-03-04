<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\FileReference;
use PHPUnit\Framework\TestCase;

class FileReferenceTest extends TestCase
{
    public function testLoadData(): void
    {
        $data = [
            'id' => 123,
            'name' => 'design_reference.png',
            'url' => 'https://example.com/reference/design_reference.png',
            'user' => [
                'id' => 1,
                'username' => 'john_doe',
                'fullName' => 'John Smith',
                'avatarUrl' => '',
            ],
            'createdAt' => '2019-09-20T11:05:24+00:00',
            'mimeType' => 'image/png',
        ];

        $fileReference = new FileReference($data);

        $this->assertEquals($data['id'], $fileReference->getId());
        $this->assertEquals($data['name'], $fileReference->getName());
        $this->assertEquals($data['url'], $fileReference->getUrl());
        $this->assertEquals($data['user'], $fileReference->getUser());
        $this->assertEquals($data['createdAt'], $fileReference->getCreatedAt());
        $this->assertEquals($data['mimeType'], $fileReference->getMimeType());
    }
}
