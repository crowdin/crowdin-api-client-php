<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\TranslationProjectBuild;
use PHPUnit\Framework\TestCase;

/**
 * Class TranslationProjectBuildTest
 * @package Crowdin\Tests\Model
 */
class TranslationProjectBuildTest extends TestCase
{
    public $translationProjectBuild;

    public $data = [
        'id' => 2,
        'projectId' => 2,
        'status' => 'finished',
        'progress' => 90,
        'attributes' => [
            'branchId' => 34,
            'targetLanguagesId' => ['uk'],
            'skipUntranslatedStrings' => true,
            'exportWithMinApprovalsCount' => 5
        ]

    ];

    public function testLoadData()
    {
        $this->translationProjectBuild = new TranslationProjectBuild($this->data);
        $this->checkData();
    }

    public function testSetData()
    {
        $this->translationProjectBuild = new TranslationProjectBuild();
        $this->translationProjectBuild->setId($this->data['id']);
        $this->translationProjectBuild->setProjectId($this->data['projectId']);
        $this->translationProjectBuild->setStatus($this->data['status']);
        $this->translationProjectBuild->setProgress($this->data['progress']);
        $this->translationProjectBuild->setAttributes($this->data['attributes']);
        $this->checkData();
    }

    public function checkData()
    {
        $this->assertEquals($this->data['id'], $this->translationProjectBuild->getId());
        $this->assertEquals($this->data['projectId'], $this->translationProjectBuild->getProjectId());
        $this->assertEquals($this->data['status'], $this->translationProjectBuild->getStatus());
        $this->assertEquals($this->data['progress'], $this->translationProjectBuild->getProgress());
        $this->assertEquals($this->data['attributes'], $this->translationProjectBuild->getAttributes());
    }
}
