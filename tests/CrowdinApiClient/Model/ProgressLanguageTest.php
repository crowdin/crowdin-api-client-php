<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

use PHPUnit\Framework\TestCase;

class ProgressLanguageTest extends TestCase
{
    /**
     * @var ProgressLanguage
     */
    public $progress;

    public $data = [
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
        'fileId' => 17,
        'eTag' => 'fd0ea167420ef1687fd16635b9fb67a3'
    ];

    public function testLoadData()
    {
        $this->progress = new ProgressLanguage($this->data);
        $this->checkData();
    }

    public function checkData()
    {
        $this->assertEquals($this->data['words'], $this->progress->getWords());
        $this->assertEquals($this->data['phrases'], $this->progress->getPhrases());
        $this->assertEquals($this->data['translationProgress'], $this->progress->getTranslationProgress());
        $this->assertEquals($this->data['approvalProgress'], $this->progress->getApprovalProgress());
        $this->assertEquals($this->data['fileId'], $this->progress->getFileId());
        $this->assertEquals($this->data['eTag'], $this->progress->getEtag());
    }
}
