<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\TranslationImport;
use PHPUnit\Framework\TestCase;

class TranslationImportTest extends TestCase
{
    public $data = [
        'identifier' => 'b5215a34-1305-4b21-8054-fc2eb252842f',
        'status' => 'finished',
        'progress' => 100,
        'attributes' => [
            'storageId' => 13,
            'fileId' => 2,
            'importEqSuggestions' => false,
            'autoApproveImported' => false,
            'translateHidden' => false,
            'addToTm' => true,
            'languageIds' => ['uk'],
        ],
        'createdAt' => '2025-09-23T11:51:08+00:00',
        'updatedAt' => '2025-09-23T11:51:08+00:00',
        'startedAt' => '2025-09-23T11:51:09+00:00',
        'finishedAt' => '2025-09-23T11:51:20+00:00',
    ];

    public function testLoadData(): void
    {
        $translationImport = new TranslationImport($this->data);

        $this->assertEquals($this->data['identifier'], $translationImport->getIdentifier());
        $this->assertEquals($this->data['status'], $translationImport->getStatus());
        $this->assertEquals($this->data['progress'], $translationImport->getProgress());
        $this->assertEquals($this->data['attributes'], $translationImport->getAttributes());
        $this->assertEquals($this->data['createdAt'], $translationImport->getCreatedAt());
        $this->assertEquals($this->data['updatedAt'], $translationImport->getUpdatedAt());
        $this->assertEquals($this->data['startedAt'], $translationImport->getStartedAt());
        $this->assertEquals($this->data['finishedAt'], $translationImport->getFinishedAt());
    }
}
