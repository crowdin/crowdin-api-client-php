<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\File;
use PHPUnit\Framework\TestCase;

class FileTest extends TestCase
{
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
        'fields' => [
            'client-company' => 'ACME Corp',
        ],
        'parserVersion' => 2,
        'createdAt' => '2019-09-19T15:10:43+00:00',
        'updatedAt' => '2019-09-19T15:10:46+00:00',
    ];

    public function testLoadData(): void
    {
        $file = new File($this->data);
        $this->assertEquals($this->data['id'], $file->getId());
        $this->assertEquals($this->data['projectId'], $file->getProjectId());
        $this->assertEquals($this->data['branchId'], $file->getBranchId());
        $this->assertEquals($this->data['directoryId'], $file->getDirectoryId());
        $this->assertEquals($this->data['name'], $file->getName());
        $this->assertEquals($this->data['title'], $file->getTitle());
        $this->assertEquals($this->data['context'], $file->getContext());
        $this->assertEquals($this->data['type'], $file->getType());
        $this->assertEquals($this->data['path'], $file->getPath());
        $this->assertEquals($this->data['revisionId'], $file->getRevisionId());
        $this->assertEquals($this->data['status'], $file->getStatus());
        $this->assertEquals($this->data['priority'], $file->getPriority());
        $this->assertEquals($this->data['createdAt'], $file->getCreatedAt());
        $this->assertEquals($this->data['updatedAt'], $file->getUpdatedAt());
        $this->assertEquals($this->data['importOptions'], $file->getImportOptions());
        $this->assertEquals($this->data['exportOptions'], $file->getExportOptions());
        $this->assertEquals($this->data['excludedTargetLanguages'], $file->getExcludedTargetLanguages());
        $this->assertEquals($this->data['parserVersion'], $file->getParserVersion());
        $this->assertEquals($this->data['fields'], $file->getFields());
    }

    public function testSetData(): void
    {
        $file = new File();
        $file->setBranchId($this->data['branchId']);
        $file->setDirectoryId($this->data['directoryId']);
        $file->setName($this->data['name']);
        $file->setTitle($this->data['title']);
        $file->setContext($this->data['context']);
        $file->setPriority($this->data['priority']);
        $file->setImportOptions($this->data['importOptions']);
        $file->setExportOptions($this->data['exportOptions']);
        $file->setExcludedTargetLanguages($this->data['excludedTargetLanguages']);
        $file->setFields($this->data['fields']);

        $this->assertEquals($this->data['branchId'], $file->getBranchId());
        $this->assertEquals($this->data['directoryId'], $file->getDirectoryId());
        $this->assertEquals($this->data['name'], $file->getName());
        $this->assertEquals($this->data['title'], $file->getTitle());
        $this->assertEquals($this->data['context'], $file->getContext());
        $this->assertEquals($this->data['priority'], $file->getPriority());
        $this->assertEquals($this->data['importOptions'], $file->getImportOptions());
        $this->assertEquals($this->data['exportOptions'], $file->getExportOptions());
        $this->assertEquals($this->data['excludedTargetLanguages'], $file->getExcludedTargetLanguages());
        $this->assertEquals($this->data['fields'], $file->getFields());
    }
}
