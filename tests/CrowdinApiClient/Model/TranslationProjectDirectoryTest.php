<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\TranslationProjectDirectory;
use PHPUnit\Framework\TestCase;

class TranslationProjectDirectoryTest extends TestCase
{
    public function testLoadData(): void
    {
        $data = [
            'id' => 2,
            'projectId' => 2,
            'status' => 'finished',
            'progress' => 100,
            'createdAt' => '2019-09-23T11:26:54+00:00',
            'updatedAt' => '2019-09-23T11:26:54+00:00',
            'finishedAt' => '2019-09-23T11:26:54+00:00',
            'attributes' => [
                'directoryId' => 4,
                'targetLanguageIds' => ['uk'],
                'skipUntranslatedStrings' => false,
                'skipUntranslatedFiles' => false,
                'exportApprovedOnly' => false,
                'preserveFolderHierarchy' => false,
            ],
        ];

        $build = new TranslationProjectDirectory($data);

        $this->assertSame($data['id'], $build->getId());
        $this->assertSame($data['status'], $build->getStatus());
        $this->assertSame($data['progress'], $build->getProgress());
        $this->assertSame($data['attributes'], $build->getAttributes());
    }

    public function testLoadDataWithoutOptionalFields(): void
    {
        $this->assertSame([], (new TranslationProjectDirectory(['id' => 2]))->getAttributes());
    }
}
