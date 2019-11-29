<?php

namespace CrowdinApiClient\Tests\Model\Enterprise;

use CrowdinApiClient\Model\Enterprise\TranslationProjectBuild;
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
        'branchId' => 34,
        'languagesId' =>
            [
                0 => 15,
            ],
        'status' => 'finished',
        'progress' =>
            [
                'percent' => 90,
                'currentLanguageId' => 'uk',
                'currentFileId' => 1,
            ],
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
        $this->translationProjectBuild->setBranchId($this->data['branchId']);
        $this->translationProjectBuild->setLanguagesId($this->data['languagesId']);
        $this->translationProjectBuild->setStatus($this->data['status']);
        $this->translationProjectBuild->setProgress($this->data['progress']);
        $this->checkData();
    }

    public function checkData()
    {
        $this->assertEquals($this->data['id'], $this->translationProjectBuild->getId());
        $this->assertEquals($this->data['projectId'], $this->translationProjectBuild->getProjectId());
        $this->assertEquals($this->data['branchId'], $this->translationProjectBuild->getBranchId());
        $this->assertEquals($this->data['languagesId'], $this->translationProjectBuild->getLanguagesId());
        $this->assertEquals($this->data['status'], $this->translationProjectBuild->getStatus());
        $this->assertEquals($this->data['progress'], $this->translationProjectBuild->getProgress());
    }
}
