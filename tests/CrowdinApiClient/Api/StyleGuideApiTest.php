<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\StyleGuide;
use CrowdinApiClient\ModelCollection;

class StyleGuideApiTest extends AbstractTestApi
{
    public function testList(): void
    {
        $this->mockRequest([
            'path' => '/style-guides',
            'method' => 'get',
            'response' => json_encode([
                'data' => [
                    [
                        'data' => [
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
                        ],
                    ],
                ],
                'pagination' => [
                    [
                        'offset' => 0,
                        'limit' => 25,
                    ],
                ],
            ]),
        ]);

        $styleGuides = $this->crowdin->styleGuide->list();

        $this->assertInstanceOf(ModelCollection::class, $styleGuides);
        $this->assertCount(1, $styleGuides);
        $this->assertInstanceOf(StyleGuide::class, $styleGuides[0]);
        $this->assertEquals(2, $styleGuides[0]->getId());
        $this->assertEquals("Be My Eyes iOS's Style Guide", $styleGuides[0]->getName());
        $this->assertEquals('Rules to be used by AI models', $styleGuides[0]->getAiInstructions());
        $this->assertEquals(2, $styleGuides[0]->getUserId());
        $this->assertEquals(['uk', 'fr', 'de'], $styleGuides[0]->getLanguageIds());
        $this->assertEquals([6], $styleGuides[0]->getProjectIds());
        $this->assertFalse($styleGuides[0]->isShared());
        $this->assertEquals(
            'https://crowdin.com/profile/{userName}/style-guides?id=1',
            $styleGuides[0]->getWebUrl()
        );
        $this->assertEquals(
            'https://storage.crowdin.com/style-guide/123/456/file.pdf',
            $styleGuides[0]->getDownloadLink()
        );
    }

    public function testCreate(): void
    {
        $this->mockRequest([
            'path' => '/style-guides',
            'method' => 'post',
            'body' => json_encode([
                'name' => "Be My Eyes iOS's Style Guide",
                'storageId' => 1,
                'aiInstructions' => 'Rules to be used by AI models',
                'languageIds' => ['uk', 'fr', 'de'],
                'projectIds' => [6],
                'isShared' => false,
            ]),
            'response' => json_encode([
                'data' => [
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
                ],
            ]),
        ]);

        $params = [
            'name' => "Be My Eyes iOS's Style Guide",
            'storageId' => 1,
            'aiInstructions' => 'Rules to be used by AI models',
            'languageIds' => ['uk', 'fr', 'de'],
            'projectIds' => [6],
            'isShared' => false,
        ];

        $styleGuide = $this->crowdin->styleGuide->create($params);

        $this->assertInstanceOf(StyleGuide::class, $styleGuide);
        $this->assertEquals(2, $styleGuide->getId());
        $this->assertEquals("Be My Eyes iOS's Style Guide", $styleGuide->getName());
    }

    public function testGet(): void
    {
        $this->mockRequestGet(
            '/style-guides/2',
            json_encode([
                'data' => [
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
                ],
            ])
        );

        $styleGuide = $this->crowdin->styleGuide->get(2);

        $this->assertInstanceOf(StyleGuide::class, $styleGuide);
        $this->assertEquals(2, $styleGuide->getId());
        $this->assertEquals("Be My Eyes iOS's Style Guide", $styleGuide->getName());
    }

    public function testDelete(): void
    {
        $this->mockRequestDelete('/style-guides/2');

        $this->crowdin->styleGuide->delete(2);
    }

    public function testUpdate(): void
    {
        $this->mockRequestPatch(
            '/style-guides/2',
            json_encode([
                'data' => [
                    'id' => 2,
                    'name' => 'Updated Style Guide',
                    'aiInstructions' => 'Updated AI instructions',
                    'userId' => 2,
                    'languageIds' => ['uk', 'fr'],
                    'projectIds' => [6],
                    'isShared' => true,
                    'webUrl' => 'https://crowdin.com/profile/{userName}/style-guides?id=1',
                    'downloadLink' => 'https://storage.crowdin.com/style-guide/123/456/file.pdf',
                    'createdAt' => '2019-09-16T13:42:04+00:00',
                    'updatedAt' => '2019-09-16T14:00:00+00:00',
                ],
            ])
        );

        $styleGuide = new StyleGuide([
            'id' => 2,
            'name' => 'Style Guide',
            'aiInstructions' => 'AI instructions',
            'userId' => 2,
            'languageIds' => ['uk', 'fr'],
            'projectIds' => [6],
            'isShared' => true,
            'webUrl' => 'https://crowdin.com/profile/{userName}/style-guides?id=1',
            'downloadLink' => 'https://storage.crowdin.com/style-guide/123/456/file.pdf',
            'createdAt' => '2019-09-16T13:42:04+00:00',
            'updatedAt' => '2019-09-16T14:00:00+00:00',
        ]);
        $styleGuide->setName('Updated Style Guide');
        $styleGuide->setAiInstructions('Updated AI instructions');

        $result = $this->crowdin->styleGuide->update($styleGuide);

        $this->assertInstanceOf(StyleGuide::class, $result);
        $this->assertEquals(2, $result->getId());
        $this->assertEquals('Updated Style Guide', $result->getName());
        $this->assertEquals('Updated AI instructions', $result->getAiInstructions());
    }
}
