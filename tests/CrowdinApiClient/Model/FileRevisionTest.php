<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\FileRevision;
use PHPUnit\Framework\TestCase;

class FileRevisionTest extends TestCase
{
    /**
     * @var array
     */
    public $data = [
        'id' => 2,
        'projectId' => 2,
        'fileId' => 248,
        'restoreToRevision' => null,
        'info' => [
            'added' => [
                'strings' => 17,
                'words' => 43,
            ],
            'deleted' => [
                'strings' => 17,
                'words' => 43,
            ],
            'updated' => [
                'strings' => 17,
                'words' => 43,
            ],
        ],
        'date' => '2019-09-20T09:08:16+00:00',
    ];

    public function testLoadData(): void
    {
        $fileRevision = new FileRevision($this->data);

        $this->assertEquals($this->data['id'], $fileRevision->getId());
        $this->assertEquals($this->data['projectId'], $fileRevision->getProjectId());
        $this->assertEquals($this->data['fileId'], $fileRevision->getFileId());
        $this->assertEquals($this->data['restoreToRevision'], $fileRevision->getRestoreToRevision());
        $this->assertEquals($this->data['info'], $fileRevision->getInfo());
        $this->assertEquals($this->data['date'], $fileRevision->getDate());
    }
}
