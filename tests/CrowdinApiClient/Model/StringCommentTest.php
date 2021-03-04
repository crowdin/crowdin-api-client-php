<?php

namespace CrowdinApiClient\Test\Model;

use CrowdinApiClient\Model\StringComment;
use PHPUnit\Framework\TestCase;

class StringCommentTest extends TestCase
{
    /**
     * @var StringComment
     */
    public $stringComment;

    /**
     * @var array
     */
    public $data = [
        'id' => 1,
        'text' => 'Some comment',
        'userId' => 2,
        'stringId' => 3,
        'user' => [
            'id' => 2,
            'username' => 'john_smith',
            'fullName' => 'John Smith',
            'avatarUrl' => '',
        ],
        'string' => [
            'id' => 3,
            'text' => 'Some string',
            'type' => 'text',
            'hasPlurals' => false,
            'isIcu' => false,
            'context' => 'Document Title\\r\\nXPath: /html/head/title',
            'fileId' => 4
        ],
        'languageId' => 'uk',
        'type' => 'issue',
        'issueType' => 'source_mistake',
        'issueStatus' => 'resolved',
        'resolverId' => 5,
        'resolver' => [
            'id' => 5,
            'username' => 'john_smith',
            'fullName' => 'John Smith',
            'avatarUrl' => '',
        ],
        'resolvedAt' => "2019-09-20T11:05:24+00:00",
        'createdAt' => "2019-09-10T10:07:21+00:00",
    ];

    public function testLoadData()
    {
        $this->stringComment = new StringComment($this->data);
        $this->checkData();
    }

    public function testSetData()
    {
        $this->stringComment = new StringComment();
        $this->stringComment->setText($this->data['text']);
        $this->stringComment->setLanguageId($this->data['languageId']);
        $this->stringComment->setType($this->data['type']);
        $this->stringComment->setIssueType($this->data['issueType']);
        $this->stringComment->setIssueStatus($this->data['issueStatus']);
        $this->stringComment->setResolverId($this->data['resolverId']);
        $this->stringComment->setResolver($this->data['resolver']);
        $this->stringComment->setCreatedAt($this->data['createdAt']);

        $this->assertEquals($this->data['text'], $this->stringComment->getText());
        $this->assertEquals($this->data['languageId'], $this->stringComment->getLanguageId());
        $this->assertEquals($this->data['type'], $this->stringComment->getType());
        $this->assertEquals($this->data['issueType'], $this->stringComment->getIssueType());
        $this->assertEquals($this->data['issueStatus'], $this->stringComment->getIssueStatus());
        $this->assertEquals($this->data['resolverId'], $this->stringComment->getResolverId());
        $this->assertEquals($this->data['resolver'], $this->stringComment->getResolver());
        $this->assertEquals($this->data['createdAt'], $this->stringComment->getCreatedAt());
    }

    public function checkData()
    {
        $this->assertEquals($this->data['id'], $this->stringComment->getId());
        $this->assertEquals($this->data['text'], $this->stringComment->getText());
        $this->assertEquals($this->data['userId'], $this->stringComment->getUserId());
        $this->assertEquals($this->data['stringId'], $this->stringComment->getStringId());
        $this->assertEquals($this->data['user'], $this->stringComment->getUser());
        $this->assertEquals($this->data['string'], $this->stringComment->getString());
        $this->assertEquals($this->data['languageId'], $this->stringComment->getLanguageId());
        $this->assertEquals($this->data['type'], $this->stringComment->getType());
        $this->assertEquals($this->data['issueType'], $this->stringComment->getIssueType());
        $this->assertEquals($this->data['issueStatus'], $this->stringComment->getIssueStatus());
        $this->assertEquals($this->data['resolverId'], $this->stringComment->getResolverId());
        $this->assertEquals($this->data['resolver'], $this->stringComment->getResolver());
        $this->assertEquals($this->data['resolvedAt'], $this->stringComment->getResolvedAt());
        $this->assertEquals($this->data['createdAt'], $this->stringComment->getCreatedAt());
    }
}
