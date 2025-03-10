<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\TranslationProjectBuild;
use PHPUnit\Framework\TestCase;

class TranslationProjectBuildTest extends TestCase
{
    public $data = [
        'id' => 2,
        'projectId' => 2,
        'status' => 'finished',
        'progress' => 90,
        'attributes' => [
            'branchId' => 34,
            'targetLanguagesId' => ['uk'],
            'skipUntranslatedStrings' => true,
            'exportWithMinApprovalsCount' => 5,
        ],
    ];

    public function testLoadData(): void
    {
        $translationProjectBuild = new TranslationProjectBuild($this->data);
        $this->assertEquals($this->data['id'], $translationProjectBuild->getId());
        $this->assertEquals($this->data['projectId'], $translationProjectBuild->getProjectId());
        $this->assertEquals($this->data['status'], $translationProjectBuild->getStatus());
        $this->assertEquals($this->data['progress'], $translationProjectBuild->getProgress());
        $this->assertEquals($this->data['attributes'], $translationProjectBuild->getAttributes());
    }
}
