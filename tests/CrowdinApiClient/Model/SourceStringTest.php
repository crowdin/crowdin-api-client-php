<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\SourceString;
use PHPUnit\Framework\TestCase;

/**
 * Class SourceStringTest
 * @package Crowdin\Tests\Model
 */
class SourceStringTest extends TestCase
{
    public $sourceString;

    public $data = [
        'id' => 2814,
        'projectId' => 2,
        'fileId' => 48,
        'identifier' => '6a1821e6499ebae94de4b880fd93b985',
        'text' => 'Not all videos are shown to users. See more',
        'type' => 'text',
        'context' => 'shown on main page',
        'maxLength' => 35,
        'isHidden' => false,
        'revision' => 1,
        'hasPlurals' => false,
        'isIcu' => false,
        'createdAt' => '2019-09-20T12:43:57+00:00',
        'updatedAt' => '2019-09-20T13:24:01+00:00',
    ];

    public function testLoadData()
    {
        $this->sourceString = new SourceString($this->data);
        $this->checkData();
    }

    public function testSetData()
    {
        $this->sourceString = new SourceString();
        $this->sourceString->setText($this->data['text']);
        $this->sourceString->setContext($this->data['context']);
        $this->sourceString->setMaxLength($this->data['maxLength']);
        $this->sourceString->setIsHidden($this->data['isHidden']);

        $this->assertEquals($this->data['text'], $this->sourceString->getText());
        $this->assertEquals($this->data['context'], $this->sourceString->getContext());
        $this->assertEquals($this->data['maxLength'], $this->sourceString->getMaxLength());
        $this->assertEquals($this->data['isHidden'], $this->sourceString->isHidden());
    }

    public function checkData()
    {
        $this->assertEquals($this->data['id'], $this->sourceString->getId());
        $this->assertEquals($this->data['projectId'], $this->sourceString->getProjectId());
        $this->assertEquals($this->data['fileId'], $this->sourceString->getFileId());
        $this->assertEquals($this->data['identifier'], $this->sourceString->getIdentifier());
        $this->assertEquals($this->data['text'], $this->sourceString->getText());
        $this->assertEquals($this->data['type'], $this->sourceString->getType());
        $this->assertEquals($this->data['context'], $this->sourceString->getContext());
        $this->assertEquals($this->data['maxLength'], $this->sourceString->getMaxLength());
        $this->assertEquals($this->data['isHidden'], $this->sourceString->isHidden());
        $this->assertEquals($this->data['revision'], $this->sourceString->getRevision());
        $this->assertEquals($this->data['hasPlurals'], $this->sourceString->isHasPlurals());
        $this->assertEquals($this->data['isIcu'], $this->sourceString->isIcu());
        $this->assertEquals($this->data['createdAt'], $this->sourceString->getCreatedAt());
        $this->assertEquals($this->data['updatedAt'], $this->sourceString->getUpdatedAt());
    }
}
