<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\Manager;
use CrowdinApiClient\ModelCollection;

class ManagerApiTest extends AbstractTestApi
{
    public function testList(): void
    {
        $this->mockRequest([
            'path' => '/managers?status=pending&limit=10',
            'method' => 'get',
            'response' => json_encode([
                'data' => [['data' => $this->managerData()]],
                'pagination' => ['offset' => 0, 'limit' => 10],
            ]),
        ]);

        $managers = $this->crowdin->manager->list(['status' => 'pending', 'limit' => 10]);

        $this->assertInstanceOf(ModelCollection::class, $managers);
        $this->assertCount(1, $managers);
        $this->assertInstanceOf(Manager::class, $managers[0]);
        $this->assertEquals(13240049, $managers[0]->getId());
    }

    public function testGet(): void
    {
        $this->mockRequest([
            'path' => '/managers/13240049',
            'method' => 'get',
            'response' => json_encode(['data' => $this->managerData()]),
        ]);

        $manager = $this->crowdin->manager->get(13240049);

        $this->assertInstanceOf(Manager::class, $manager);
        $this->assertEquals('active', $manager->getStatus());
    }

    public function testCreate(): void
    {
        $data = [
            'username' => 'taras.m',
            'projectIds' => [101, 102],
            'message' => 'Hi Taras',
        ];

        $this->mockRequest([
            'path' => '/managers',
            'method' => 'post',
            'body' => json_encode($data),
            'response' => json_encode(['data' => $this->managerData()]),
        ]);

        $manager = $this->crowdin->manager->create($data);

        $this->assertInstanceOf(Manager::class, $manager);
        $this->assertEquals([101, 102], $manager->getProjectIds());
    }

    public function testUpdate(): void
    {
        $manager = new Manager($this->managerData());
        $manager->setStyleGuideIds([2, 3]);

        $this->mockRequest([
            'path' => '/managers/13240049',
            'method' => 'patch',
            'body' => json_encode([['op' => 'replace', 'path' => '/styleGuideIds', 'value' => [2, 3]]]),
            'response' => json_encode(['data' => ['styleGuideIds' => [2, 3]] + $this->managerData()]),
        ]);

        $updated = $this->crowdin->manager->update($manager);

        $this->assertInstanceOf(Manager::class, $updated);
        $this->assertEquals([2, 3], $updated->getStyleGuideIds());
    }

    public function testDelete(): void
    {
        $this->mockRequestDelete('/managers/13240049');
        $this->crowdin->manager->delete(13240049);
    }

    private function managerData(): array
    {
        return [
            'id' => 13240049,
            'user' => [
                'id' => 13240049,
                'username' => 'taras.m',
                'fullName' => 'Taras M',
                'avatarUrl' => 'https://crowdin-static.downloads.crowdin.com/avatar/13240049/medium/avatar.png',
            ],
            'status' => 'active',
            'isApplicationAgent' => false,
            'projectIds' => [101, 102],
            'tmIds' => [9, 11],
            'projectDefaultTmIds' => [11],
            'glossaryIds' => [4],
            'projectDefaultGlossaryIds' => [],
            'styleGuideIds' => [2],
            'createdAt' => '2026-10-20T10:00:00+00:00',
        ];
    }
}
