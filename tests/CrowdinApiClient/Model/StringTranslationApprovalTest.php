<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\StringTranslationApproval;
use PHPUnit\Framework\TestCase;

class StringTranslationApprovalTest extends TestCase
{
    public $stringTranslationApproval;

    public $data = [
        'id' => 190695,
        'user' =>
            [
                'id' => 19,
                'login' => 'john_doe',
            ],
        'translationId' => 190695,
        'stringId' => 2345,
        'languageId' => 'uk',
        'workflowStepId' => 122,
        'createdAt' => '2019-09-19T12:42:12+00:00',
    ];

    public function testLoadData()
    {
        $this->stringTranslationApproval = new StringTranslationApproval($this->data);
        $this->checkData();
    }

    public function testSetData()
    {
        $this->stringTranslationApproval = new StringTranslationApproval();
        $this->stringTranslationApproval->setId($this->data['id']);
        $this->stringTranslationApproval->setUser($this->data['user']);
        $this->stringTranslationApproval->setTranslationId($this->data['translationId']);
        $this->stringTranslationApproval->setStringId($this->data['stringId']);
        $this->stringTranslationApproval->setLanguageId($this->data['languageId']);
        $this->stringTranslationApproval->setWorkflowStepId($this->data['workflowStepId']);
        $this->stringTranslationApproval->setCreatedAt($this->data['createdAt']);
        $this->checkData();
    }

    public function checkData()
    {
        $this->assertEquals($this->data['id'], $this->stringTranslationApproval->getId());
        $this->assertEquals($this->data['user'], $this->stringTranslationApproval->getUser());
        $this->assertEquals($this->data['translationId'], $this->stringTranslationApproval->getTranslationId());
        $this->assertEquals($this->data['stringId'], $this->stringTranslationApproval->getStringId());
        $this->assertEquals($this->data['languageId'], $this->stringTranslationApproval->getLanguageId());
        $this->assertEquals($this->data['workflowStepId'], $this->stringTranslationApproval->getWorkflowStepId());
        $this->assertEquals($this->data['createdAt'], $this->stringTranslationApproval->getCreatedAt());
    }
}
