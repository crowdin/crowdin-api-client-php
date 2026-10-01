<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Api\Enterprise;

use CrowdinApiClient\Model\Enterprise\CustomPlaceholder;
use CrowdinApiClient\Model\Enterprise\ProjectPlaceholder;
use CrowdinApiClient\ModelCollection;

class CustomPlaceholderApiTest extends AbstractTestApi
{
    private function customPlaceholderData(): array
    {
        return [
            'id' => 3,
            'description' => 'URL',
            'definition' => 'start, then "http", maybe "s", then "://", anything but " ", end',
            'argumentDelimiter' => '"',
        ];
    }

    private function projectPlaceholderData(): array
    {
        return [
            'id' => 5,
            'customPlaceholderId' => 3,
            'type' => 'high',
            'index' => 1,
            'isBlocking' => false,
            'formats' => ['docbook'],
        ];
    }

    public function testList(): void
    {
        $this->mockRequestGet(
            '/custom-placeholders?limit=10',
            json_encode([
                'data' => [['data' => $this->customPlaceholderData()]],
                'pagination' => ['offset' => 0, 'limit' => 10],
            ])
        );

        $placeholders = $this->crowdin->customPlaceholder->list(['limit' => 10]);

        $this->assertInstanceOf(ModelCollection::class, $placeholders);
        $this->assertCount(1, $placeholders);
        $this->assertInstanceOf(CustomPlaceholder::class, $placeholders[0]);
        $this->assertEquals(3, $placeholders[0]->getId());
    }

    public function testCreate(): void
    {
        $data = ['definition' => 'start, then "http", end', 'description' => 'URL'];

        $this->mockRequest([
            'path' => '/custom-placeholders',
            'method' => 'post',
            'body' => json_encode($data),
            'response' => json_encode(['data' => $this->customPlaceholderData()]),
        ]);

        $placeholder = $this->crowdin->customPlaceholder->create($data);

        $this->assertInstanceOf(CustomPlaceholder::class, $placeholder);
        $this->assertEquals('URL', $placeholder->getDescription());
    }

    public function testGet(): void
    {
        $this->mockRequestGet('/custom-placeholders/3', json_encode(['data' => $this->customPlaceholderData()]));

        $placeholder = $this->crowdin->customPlaceholder->get(3);

        $this->assertInstanceOf(CustomPlaceholder::class, $placeholder);
        $this->assertEquals('"', $placeholder->getArgumentDelimiter());
    }

    public function testUpdate(): void
    {
        $placeholder = new CustomPlaceholder($this->customPlaceholderData());
        $placeholder->setDescription('Web link');

        $this->mockRequest([
            'path' => '/custom-placeholders/3',
            'method' => 'patch',
            'body' => json_encode([['op' => 'replace', 'path' => '/description', 'value' => 'Web link']]),
            'response' => json_encode([
                'data' => array_merge($this->customPlaceholderData(), ['description' => 'Web link']),
            ]),
        ]);

        $updated = $this->crowdin->customPlaceholder->update($placeholder);

        $this->assertInstanceOf(CustomPlaceholder::class, $updated);
        $this->assertEquals('Web link', $updated->getDescription());
    }

    public function testDelete(): void
    {
        $this->mockRequestDelete('/custom-placeholders/3');

        $this->crowdin->customPlaceholder->delete(3);
    }

    public function testListProjectPlaceholders(): void
    {
        $this->mockRequestGet(
            '/projects/2/placeholders',
            json_encode([
                'data' => [['data' => $this->projectPlaceholderData()]],
                'pagination' => ['offset' => 0, 'limit' => 25],
            ])
        );

        $placeholders = $this->crowdin->customPlaceholder->listProjectPlaceholders(2);

        $this->assertInstanceOf(ModelCollection::class, $placeholders);
        $this->assertCount(1, $placeholders);
        $this->assertInstanceOf(ProjectPlaceholder::class, $placeholders[0]);
        $this->assertEquals(3, $placeholders[0]->getCustomPlaceholderId());
    }

    public function testAddProjectPlaceholder(): void
    {
        $data = ['customPlaceholderId' => 3, 'type' => 'high', 'formats' => ['docbook']];

        $this->mockRequest([
            'path' => '/projects/2/placeholders',
            'method' => 'post',
            'body' => json_encode($data),
            'response' => json_encode(['data' => $this->projectPlaceholderData()]),
        ]);

        $placeholder = $this->crowdin->customPlaceholder->addProjectPlaceholder(2, $data);

        $this->assertInstanceOf(ProjectPlaceholder::class, $placeholder);
        $this->assertEquals(5, $placeholder->getId());
    }

    public function testGetProjectPlaceholder(): void
    {
        $this->mockRequestGet('/projects/2/placeholders/5', json_encode(['data' => $this->projectPlaceholderData()]));

        $placeholder = $this->crowdin->customPlaceholder->getProjectPlaceholder(2, 5);

        $this->assertInstanceOf(ProjectPlaceholder::class, $placeholder);
        $this->assertEquals('high', $placeholder->getType());
    }

    public function testUpdateProjectPlaceholder(): void
    {
        $placeholder = new ProjectPlaceholder($this->projectPlaceholderData());
        $placeholder->setIsBlocking(true);
        $placeholder->setFormats([]);

        $this->mockRequest([
            'path' => '/projects/2/placeholders/5',
            'method' => 'patch',
            'body' => json_encode([
                ['op' => 'replace', 'path' => '/isBlocking', 'value' => true],
                ['op' => 'replace', 'path' => '/formats', 'value' => []],
            ]),
            'response' => json_encode([
                'data' => array_merge($this->projectPlaceholderData(), ['isBlocking' => true, 'formats' => []]),
            ]),
        ]);

        $updated = $this->crowdin->customPlaceholder->updateProjectPlaceholder(2, $placeholder);

        $this->assertInstanceOf(ProjectPlaceholder::class, $updated);
        $this->assertTrue($updated->getIsBlocking());
        $this->assertEquals([], $updated->getFormats());
    }

    public function testDeleteProjectPlaceholder(): void
    {
        $this->mockRequestDelete('/projects/2/placeholders/5');

        $this->crowdin->customPlaceholder->deleteProjectPlaceholder(2, 5);
    }
}
