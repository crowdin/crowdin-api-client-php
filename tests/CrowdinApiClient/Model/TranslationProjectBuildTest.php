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

    public function setUp()
    {
        parent::setUp();
        $this->translationProjectBuild = new TranslationProjectBuild($this->data);
    }

    public function testLoadData()
    {
        $this->assertEquals($this->data['id'], $this->translationProjectBuild->getId());
        $this->assertEquals($this->data['projectId'], $this->translationProjectBuild->getProjectId());
        $this->assertEquals($this->data['branchId'], $this->translationProjectBuild->getBranchId());
        $this->assertEquals($this->data['languagesId'], $this->translationProjectBuild->getLanguagesId());
        $this->assertEquals($this->data['status'], $this->translationProjectBuild->getStatus());
        $this->assertEquals($this->data['progress'], $this->translationProjectBuild->getProgress());
    }
}
