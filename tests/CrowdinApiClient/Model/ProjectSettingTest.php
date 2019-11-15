<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\ProjectSetting;
use PHPUnit\Framework\TestCase;

/**
 * Class ProjectSettingTest
 * @package Crowdin\Tests\Model
 */
class ProjectSettingTest extends TestCase
{
    /**
     * @var ProjectSetting
     */
    public $projectSetting;

    /**
     * @var array
     */
    public $data = [
        'projectId' => 1,
        'translateDuplicates' => 1,
        'isMtAllowed' => true,
        'autoSubstitution' => true,
        'exportTranslatedOnly' => false,
        'exportApprovedOnly' => false,
        'autoTranslateDialects' => true,
        'publicDownloads' => true,
        'useGlobalTm' => false,
        'inContext' => true,
        'pseudoLanguageId' => 'uk',
        'qaCheckIsActive' => true,
        'lowestQualityProjectGoalId' => 1,
        'qaCheckCategories' =>
            [
                'empty' => true,
                'size' => true,
                'tags' => true,
                'spaces' => true,
                'variables' => true,
                'punctuation' => true,
                'symbolRegister' => true,
                'specialSymbols' => true,
                'wrongTranslation' => true,
                'spellcheck' => true,
                'icu' => true,
            ],
    ];

    public function setUp()
    {
        parent::setUp();
        $this->projectSetting = new ProjectSetting($this->data);
    }

    /**
     * @test
     */
    public function testLoadData()
    {
        $this->assertEquals($this->data['projectId'], $this->projectSetting->getProjectId());
        $this->assertEquals($this->data['translateDuplicates'], $this->projectSetting->getTranslateDuplicates());
        $this->assertEquals($this->data['isMtAllowed'], $this->projectSetting->isMtAllowed());
        $this->assertEquals($this->data['autoSubstitution'], $this->projectSetting->isAutoSubstitution());
        $this->assertEquals($this->data['exportTranslatedOnly'], $this->projectSetting->isExportTranslatedOnly());
        $this->assertEquals($this->data['exportApprovedOnly'], $this->projectSetting->isExportApprovedOnly());
        $this->assertEquals($this->data['autoTranslateDialects'], $this->projectSetting->isAutoTranslateDialects());
        $this->assertEquals($this->data['publicDownloads'], $this->projectSetting->isPublicDownloads());
        $this->assertEquals($this->data['useGlobalTm'], $this->projectSetting->isUseGlobalTm());
        $this->assertEquals($this->data['inContext'], $this->projectSetting->isInContext());
        $this->assertEquals($this->data['pseudoLanguageId'], $this->projectSetting->getPseudoLanguageId());
        $this->assertEquals($this->data['qaCheckIsActive'], $this->projectSetting->isQaCheckIsActive());
        $this->assertEquals($this->data['lowestQualityProjectGoalId'], $this->projectSetting->getLowestQualityProjectGoalId());
        $this->assertEquals($this->data['qaCheckCategories'], $this->projectSetting->getQaCheckCategories());
    }
}
