<?php

namespace CrowdinApiClient\Tests\Model\Enterprise;

use CrowdinApiClient\Model\Enterprise\FileRevision;
use PHPUnit\Framework\TestCase;

/**
 * Class FileRevisionTest
 * @package CrowdinApiClient\Tests\Model
 */
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

    public function testLoadData()
    {
        $this->fileRevision = new FileRevision($this->data);
        $this->checkData();
    }

    public function testSetData()
    {
        $this->fileRevision = new FileRevision();
        $this->fileRevision->setId($this->data['id']);
        $this->fileRevision->setProjectId($this->data['projectId']);
        $this->fileRevision->setRevision($this->data['revision']);
        $this->fileRevision->setRevertTo($this->data['revertTo']);
        $this->fileRevision->setTranslationChunks($this->data['translationChunks']);
        $this->fileRevision->setInfo($this->data['info']);
        $this->fileRevision->setDate($this->data['date']);
        $this->checkData();
    }

    public function checkData()
    {
        $this->assertEquals($this->data['id'], $this->fileRevision->getId());
        $this->assertEquals($this->data['projectId'], $this->fileRevision->getProjectId());
        $this->assertEquals($this->data['revision'], $this->fileRevision->getRevision());
        $this->assertEquals($this->data['revertTo'], $this->fileRevision->getRevertTo());
        $this->assertEquals($this->data['translationChunks'], $this->fileRevision->getTranslationChunks());
        $this->assertEquals($this->data['info'], $this->fileRevision->getInfo());
        $this->assertEquals($this->data['date'], $this->fileRevision->getDate());
    }
}
