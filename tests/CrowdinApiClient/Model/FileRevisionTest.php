<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\FileRevision;
use PHPUnit\Framework\TestCase;

class FileRevisionTest extends TestCase
{
    public static function dataProvider(): array
    {
        return [
            'withIntRestoreToRevision' => [
                'data' => [
                    'id' => 2,
                    'projectId' => 2,
                    'fileId' => 248,
                    'restoreToRevision' => 2,
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
                ]
            ],
            'withNullRestoreToRevision' => [
                'data' => [
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
                ]
            ]
        ];
    }

    /**
     * @dataProvider dataProvider
     */
    public function testLoadData(array $data): void
    {
        $fileRevision = new FileRevision($data);

        $this->assertEquals($data['id'], $fileRevision->getId());
        $this->assertEquals($data['projectId'], $fileRevision->getProjectId());
        $this->assertEquals($data['fileId'], $fileRevision->getFileId());
        $this->assertEquals($data['restoreToRevision'], $fileRevision->getRestoreToRevision());
        $this->assertEquals($data['info'], $fileRevision->getInfo());
        $this->assertEquals($data['date'], $fileRevision->getDate());
    }
}
