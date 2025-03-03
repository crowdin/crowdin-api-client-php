<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\File;
use PHPUnit\Framework\TestCase;

class FileTest extends TestCase
{
    /**
     * @var File
     */
    public $file;

    /**
     * @var array
     */
    public $data = [
        'id' => 44,
        'projectId' => 2,
        'branchId' => 34,
        'directoryId' => 4,
        'name' => 'umbrella_app.xliff',
        'title' => 'source_app_info',
        'context' => 'Context for translators',
        'type' => 'xliff',
        'path' => '/someBranch/someDir/umbrella_app.xliff',
        'status' => 'active',
        'revisionId' => 1,
        'priority' => 'normal',
        'importOptions' => [
            'firstLineContainsHeader' => true,
            'scheme' => [
                'identifier' => 0,
                'sourcePhrase' => 1,
                'en' => 2,
                'de' => 3,
            ],
        ],
        'exportOptions' => [
            'escapeQuotes' => 3,
        ],
        'excludedTargetLanguages' => [
            'es',
            'pl',
        ],
        'parserVersion' => 2,
        'createdAt' => '2019-09-19T15:10:43+00:00',
        'updatedAt' => '2019-09-19T15:10:46+00:00',
    ];

    public function testLoadData(): void
    {
        $this->file = new File($this->data);
        $this->checkData();
    }

    public function testSetData(): void
    {
        $this->file = new File();
        $this->file->setBranchId($this->data['branchId']);
        $this->file->setDirectoryId($this->data['directoryId']);
        $this->file->setName($this->data['name']);
        $this->file->setTitle($this->data['title']);
        $this->file->setContext($this->data['context']);
        $this->file->setPriority($this->data['priority']);
        $this->file->setImportOptions($this->data['importOptions']);
        $this->file->setExportOptions($this->data['exportOptions']);
        $this->file->setExcludedTargetLanguages($this->data['excludedTargetLanguages']);

        $this->assertEquals($this->data['branchId'], $this->file->getBranchId());
        $this->assertEquals($this->data['directoryId'], $this->file->getDirectoryId());
        $this->assertEquals($this->data['name'], $this->file->getName());
        $this->assertEquals($this->data['title'], $this->file->getTitle());
        $this->assertEquals($this->data['context'], $this->file->getContext());
        $this->assertEquals($this->data['priority'], $this->file->getPriority());
        $this->assertEquals($this->data['importOptions'], $this->file->getImportOptions());
        $this->assertEquals($this->data['exportOptions'], $this->file->getExportOptions());
        $this->assertEquals($this->data['excludedTargetLanguages'], $this->file->getExcludedTargetLanguages());
    }

    public function checkData(): void
    {
        $this->assertEquals($this->data['id'], $this->file->getId());
        $this->assertEquals($this->data['projectId'], $this->file->getProjectId());
        $this->assertEquals($this->data['branchId'], $this->file->getBranchId());
        $this->assertEquals($this->data['directoryId'], $this->file->getDirectoryId());
        $this->assertEquals($this->data['name'], $this->file->getName());
        $this->assertEquals($this->data['title'], $this->file->getTitle());
        $this->assertEquals($this->data['context'], $this->file->getContext());
        $this->assertEquals($this->data['type'], $this->file->getType());
        $this->assertEquals($this->data['path'], $this->file->getPath());
        $this->assertEquals($this->data['revisionId'], $this->file->getRevisionId());
        $this->assertEquals($this->data['status'], $this->file->getStatus());
        $this->assertEquals($this->data['priority'], $this->file->getPriority());
        $this->assertEquals($this->data['createdAt'], $this->file->getCreatedAt());
        $this->assertEquals($this->data['updatedAt'], $this->file->getUpdatedAt());
        $this->assertEquals($this->data['importOptions'], $this->file->getImportOptions());
        $this->assertEquals($this->data['exportOptions'], $this->file->getExportOptions());
        $this->assertEquals($this->data['excludedTargetLanguages'], $this->file->getExcludedTargetLanguages());
        $this->assertEquals($this->data['parserVersion'], $this->file->getParserVersion());
    }
}
