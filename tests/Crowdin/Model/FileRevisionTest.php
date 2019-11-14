<?php

namespace Crowdin\Tests\Model;

use Crowdin\Model\FileRevision;
use PHPUnit\Framework\TestCase;

class FileRevisionTest extends TestCase
{
    public $fileRevision;

    public $data = [
        'id' => 16,
        'projectId' => 2,
        'revision' => 2,
        'revertTo' => 0,
        'translationChunks' => 1,
        'info' =>
            [
                'added' =>
                    [
                        'strings' => 17,
                        'words' => 43,
                        'chars' => 242,
                        'charsWithSpaces' => 268,
                    ],
                'deleted' =>
                    [
                        'strings' => 17,
                        'words' => 43,
                        'chars' => 242,
                        'charsWithSpaces' => 268,
                    ],
                'changed' =>
                    [
                        'strings' => 17,
                        'words' => 43,
                        'chars' => 242,
                        'charsWithSpaces' => 268,
                    ],
                'updated' =>
                    [
                        'strings' => 17,
                        'words' => 43,
                        'chars' => 242,
                        'charsWithSpaces' => 268,
                    ],
                'translated' =>
                    [
                        'strings' => 17,
                        'words' => 43,
                        'chars' => 242,
                        'charsWithSpaces' => 268,
                    ],
                'approved' =>
                    [
                        'strings' => 17,
                        'words' => 43,
                        'chars' => 242,
                        'charsWithSpaces' => 268,
                    ],
                'addedToTranslate' =>
                    [
                        'strings' => 17,
                        'words' => 43,
                        'chars' => 242,
                        'charsWithSpaces' => 268,
                    ],
            ],
        'date' => '2019-09-20T09:08:16+00:00',
    ];

    public function setUp()
    {
        parent::setUp();
        $this->fileRevision = new FileRevision($this->data);
    }

    public function testLoadData()
    {
        $this->assertEquals($this->data['id'], $this->fileRevision->getId());
        $this->assertEquals($this->data['projectId'], $this->fileRevision->getProjectId());
        $this->assertEquals($this->data['revision'], $this->fileRevision->getRevision());
        $this->assertEquals($this->data['revertTo'], $this->fileRevision->getRevertTo());
        $this->assertEquals($this->data['translationChunks'], $this->fileRevision->getTranslationChunks());
        $this->assertEquals($this->data['info'], $this->fileRevision->getInfo());
    }
}
