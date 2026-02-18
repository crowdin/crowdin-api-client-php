<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\FileFormatSettings;
use PHPUnit\Framework\TestCase;

class FileFormatSettingsTest extends TestCase
{
    /**
     * @var FileFormatSettings
     */
    public $fileFormatSettings;

    public $data = [
        'id' => 10,
        'name' => 'Android XML',
        'format' => 'android',
        'extensions' => [
            'xml',
        ],
        'settings' => [
            'exportPattern' => 'android.test.xml',
        ],
        'createdAt' => '2025-03-03T15:36:18+00:00',
        'updatedAt' => '2025-03-03T15:36:18+00:00',
    ];

    public function testLoadData(): void
    {
        $this->fileFormatSettings = new FileFormatSettings($this->data);

        $this->assertEquals($this->data['id'], $this->fileFormatSettings->getId());
        $this->assertEquals($this->data['name'], $this->fileFormatSettings->getName());
        $this->assertEquals($this->data['format'], $this->fileFormatSettings->getFormat());
        $this->assertEquals($this->data['extensions'], $this->fileFormatSettings->getExtensions());
        $this->assertEquals($this->data['settings'], $this->fileFormatSettings->getSettings());
        $this->assertEquals($this->data['createdAt'], $this->fileFormatSettings->getCreatedAt());
        $this->assertEquals($this->data['updatedAt'], $this->fileFormatSettings->getUpdatedAt());
    }

    public function testSetData(): void
    {
        $this->fileFormatSettings = new FileFormatSettings($this->data);
        $this->fileFormatSettings->setFormat('new format');
        $this->fileFormatSettings->setSettings(['exportPattern' => 'android.test.xml']);

        $this->assertSame('new format', $this->fileFormatSettings->getFormat());
        $this->assertSame(['exportPattern' => 'android.test.xml'], $this->fileFormatSettings->getSettings());
    }
}
