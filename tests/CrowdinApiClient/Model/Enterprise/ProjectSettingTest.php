<?php

namespace CrowdinApiClient\Tests\Model\Enterprise;

use CrowdinApiClient\Model\Enterprise\ProjectSetting;
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

    /**
     * @test
     */
    public function testLoadData()
    {
        $this->projectSetting = new ProjectSetting($this->data);
        $this->checkData();
    }

    /**
     * @test
     */
    public function testSetData()
    {
        $this->projectSetting = new ProjectSetting();
        $this->projectSetting->setTranslateDuplicates($this->data['translateDuplicates']);
        $this->projectSetting->setIsMtAllowed($this->data['isMtAllowed']);
        $this->projectSetting->setAutoSubstitution($this->data['autoSubstitution']);
        $this->projectSetting->setExportTranslatedOnly($this->data['exportTranslatedOnly']);
        $this->projectSetting->setExportApprovedOnly($this->data['exportApprovedOnly']);
        $this->projectSetting->setAutoTranslateDialects($this->data['autoTranslateDialects']);
        $this->projectSetting->setPublicDownloads($this->data['publicDownloads']);
        $this->projectSetting->setUseGlobalTm($this->data['useGlobalTm']);
        $this->projectSetting->setInContext($this->data['inContext']);
        $this->projectSetting->setPseudoLanguageId($this->data['pseudoLanguageId']);
        $this->projectSetting->setQaCheckIsActive($this->data['qaCheckIsActive']);
        $this->projectSetting->setLowestQualityProjectGoalId($this->data['lowestQualityProjectGoalId']);
        $this->projectSetting->setQaCheckCategories($this->data['qaCheckCategories']);

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

    public function checkData()
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
