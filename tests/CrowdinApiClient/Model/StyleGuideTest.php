<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\StyleGuide;
use PHPUnit\Framework\TestCase;

class StyleGuideTest extends TestCase
{
    public function testLoadData(): void
    {
        $data = [
            'id' => 2,
            'name' => "Be My Eyes iOS's Style Guide",
            'aiInstructions' => 'Rules to be used by AI models',
            'userId' => 2,
            'languageIds' => ['uk', 'fr', 'de'],
            'projectIds' => [6],
            'isShared' => false,
            'webUrl' => 'https://crowdin.com/profile/{userName}/style-guides?id=1',
            'downloadLink' => 'https://storage.crowdin.com/style-guide/123/456/file.pdf',
            'createdAt' => '2019-09-16T13:42:04+00:00',
            'updatedAt' => '2019-09-16T13:42:04+00:00',
        ];

        $styleGuide = new StyleGuide($data);

        $this->assertEquals($data['id'], $styleGuide->getId());
        $this->assertEquals($data['name'], $styleGuide->getName());
        $this->assertEquals($data['aiInstructions'], $styleGuide->getAiInstructions());
        $this->assertEquals($data['userId'], $styleGuide->getUserId());
        $this->assertEquals($data['languageIds'], $styleGuide->getLanguageIds());
        $this->assertEquals($data['projectIds'], $styleGuide->getProjectIds());
        $this->assertEquals($data['isShared'], $styleGuide->isShared());
        $this->assertEquals($data['webUrl'], $styleGuide->getWebUrl());
        $this->assertEquals($data['downloadLink'], $styleGuide->getDownloadLink());
        $this->assertEquals($data['createdAt'], $styleGuide->getCreatedAt());
        $this->assertEquals($data['updatedAt'], $styleGuide->getUpdatedAt());
    }

    public function testLoadDataWithoutOptionalFields(): void
    {
        $data = [
            'id' => 2,
            'name' => "Be My Eyes iOS's Style Guide",
            'userId' => 2,
            'isShared' => false,
            'webUrl' => 'https://crowdin.com/profile/{userName}/style-guides?id=1',
            'downloadLink' => 'https://storage.crowdin.com/style-guide/123/456/file.pdf',
            'createdAt' => '2019-09-16T13:42:04+00:00',
            'updatedAt' => '2019-09-16T13:42:04+00:00',
        ];

        $styleGuide = new StyleGuide($data);

        $this->assertEquals($data['id'], $styleGuide->getId());
        $this->assertEquals($data['name'], $styleGuide->getName());
        $this->assertNull($styleGuide->getAiInstructions());
        $this->assertEquals($data['userId'], $styleGuide->getUserId());
        $this->assertNull($styleGuide->getLanguageIds());
        $this->assertNull($styleGuide->getProjectIds());
        $this->assertFalse($styleGuide->isShared());
        $this->assertEquals($data['webUrl'], $styleGuide->getWebUrl());
        $this->assertEquals($data['downloadLink'], $styleGuide->getDownloadLink());
    }

    public function testSetData(): void
    {
        $styleGuide = new StyleGuide();

        $styleGuide->setName('New Name');
        $styleGuide->setAiInstructions('New instructions');
        $styleGuide->setLanguageIds(['uk', 'fr']);
        $styleGuide->setProjectIds([1, 2, 3]);
        $styleGuide->setIsShared(true);

        $this->assertEquals('New Name', $styleGuide->getName());
        $this->assertEquals('New instructions', $styleGuide->getAiInstructions());
        $this->assertEquals(['uk', 'fr'], $styleGuide->getLanguageIds());
        $this->assertEquals([1, 2, 3], $styleGuide->getProjectIds());
        $this->assertTrue($styleGuide->isShared());
    }
}
