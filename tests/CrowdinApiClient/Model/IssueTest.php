<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\Issue;
use PHPUnit\Framework\TestCase;

class IssueTest extends TestCase
{
    /**
     * @var Issue
     */
    public $issue;

    /**
     * @var array
     */
    public $data = [
        'id' => 2,
        'text' => '@BeMyEyes  Please provide more details on where the text will be used',
        'userId' => 6,
        'stringId' => 742,
        'user' => [
            'id' => 6,
            'username' => 'john_smith',
            'fullName' => 'John Smith',
            'avatarUrl' => '',
        ],
        'string' => [
            'id' => 742,
            'text' => 'HTML page example',
            'type' => 'text',
            'hasPlurals' => false,
            'isIcu' => false,
            'context' => 'Document Title\\r\\nXPath: /html/head/title',
            'fileId' => 22,
        ],
        'languageId' => 'bg',
        'type' => 'source_mistake',
        'status' => 'unresolved',
        'createdAt' => '2019-09-20T11:05:24+00:00',
    ];

    /**
     * @test
     */
    public function testGetData()
    {
        $this->issue = new Issue($this->data);

        $this->assertEquals($this->data['id'], $this->issue->getId());
        $this->assertEquals($this->data['text'], $this->issue->getText());
        $this->assertEquals($this->data['userId'], $this->issue->getUserId());
        $this->assertEquals($this->data['stringId'], $this->issue->getStringId());
        $this->assertEquals($this->data['user'], $this->issue->getUser());
        $this->assertEquals($this->data['string'], $this->issue->getString());
        $this->assertEquals($this->data['languageId'], $this->issue->getLanguageId());
        $this->assertEquals($this->data['type'], $this->issue->getType());
        $this->assertEquals($this->data['status'], $this->issue->getStatus());
        $this->assertEquals($this->data['createdAt'], $this->issue->getCreatedAt());
    }
}
