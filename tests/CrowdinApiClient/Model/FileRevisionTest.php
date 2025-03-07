<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\FileRevision;
use PHPUnit\Framework\TestCase;

class FileRevisionTest extends TestCase
{
    /**
     * @var FileRevision
     */
    public $fileRevision;

    /**
     * @var array
     */
    public $data = [
        'id' => 2,
        'projectId' => 2,
        'fileId' => 248,
        'restoreToRevision' => 0,
        'info' =>
            [
                'added' =>
                    [
                        'strings' => 17,
                        'words' => 43,
                    ],
                'deleted' =>
                    [
                        'strings' => 17,
                        'words' => 43,
                    ],
                'updated' =>
                    [
                        'strings' => 17,
                        'words' => 43,
                    ],
            ],
        'date' => '2019-09-20T09:08:16+00:00',
    ];

    public function testLoadData()
    {
        $this->fileRevision = new FileRevision($this->data);
        $this->assertEquals($this->data['id'], $this->fileRevision->getId());
        $this->assertEquals($this->data['projectId'], $this->fileRevision->getProjectId());
        $this->assertEquals($this->data['fileId'], $this->fileRevision->getFileId());
        $this->assertEquals($this->data['restoreToRevision'], $this->fileRevision->getRestoreToRevision());
        $this->assertEquals($this->data['info'], $this->fileRevision->getInfo());
        $this->assertEquals($this->data['date'], $this->fileRevision->getDate());
    }
}
