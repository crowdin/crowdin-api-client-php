<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\ProgressFile;
use PHPUnit\Framework\TestCase;

/**
 * Class ProgressFileTest
 * @package Crowdin\Tests\Model
 */
class ProgressFileTest extends TestCase
{
    /**
     * @var ProgressFile
     */
    public $progress;

    public $data = [
        'languageId' => 'af',
        'words' =>
            [
                'total' => 7249,
                'translated' => 3651,
                'approved' => 3637,
            ],
        'phrases' =>
            [
                'total' => 3041,
                'translated' => 2631,
                'approved' => 2622,
            ],
        'translationProgress' => 86,
        'approvalProgress' => 86,
        'eTag' => 'fd0ea167420ef1687fd16635b9fb67a3'
    ];

    public function testLoadData()
    {
        $this->progress = new ProgressFile($this->data);
        $this->checkData();
    }

    public function checkData()
    {
        $this->assertEquals($this->data['languageId'], $this->progress->getLanguageId());
        $this->assertEquals($this->data['words'], $this->progress->getWords());
        $this->assertEquals($this->data['phrases'], $this->progress->getPhrases());
        $this->assertEquals($this->data['translationProgress'], $this->progress->getTranslationProgress());
        $this->assertEquals($this->data['approvalProgress'], $this->progress->getApprovalProgress());
        $this->assertEquals($this->data['eTag'], $this->progress->getEtag());
    }
}
