<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\Manager;
use PHPUnit\Framework\TestCase;

class ManagerTest extends TestCase
{
    public function testLoadData(): void
    {
        $data = [
            'id' => 13240049,
            'user' => ['id' => 13240049, 'username' => 'taras.m', 'fullName' => 'Taras M', 'avatarUrl' => 'https://example.com/a.png'],
            'status' => 'active',
            'isApplicationAgent' => true,
            'projectIds' => [101],
            'tmIds' => [9, 11],
            'projectDefaultTmIds' => [11],
            'glossaryIds' => [4, 5],
            'projectDefaultGlossaryIds' => [5],
            'styleGuideIds' => [2],
            'createdAt' => '2026-10-20T10:00:00+00:00',
        ];

        $manager = new Manager($data);

        $this->assertSame($data['id'], $manager->getId());
        $this->assertSame($data['user'], $manager->getUser());
        $this->assertSame($data['status'], $manager->getStatus());
        $this->assertTrue($manager->isApplicationAgent());
        $this->assertSame($data['projectIds'], $manager->getProjectIds());
        $this->assertSame($data['tmIds'], $manager->getTmIds());
        $this->assertSame($data['projectDefaultTmIds'], $manager->getProjectDefaultTmIds());
        $this->assertSame($data['glossaryIds'], $manager->getGlossaryIds());
        $this->assertSame($data['projectDefaultGlossaryIds'], $manager->getProjectDefaultGlossaryIds());
        $this->assertSame($data['styleGuideIds'], $manager->getStyleGuideIds());
        $this->assertSame($data['createdAt'], $manager->getCreatedAt());
    }

    public function testLoadDataWithoutOptionalFields(): void
    {
        $manager = new Manager(['id' => 1, 'status' => 'pending', 'createdAt' => null]);

        $this->assertSame([], $manager->getUser());
        $this->assertFalse($manager->isApplicationAgent());
        $this->assertSame([], $manager->getProjectIds());
        $this->assertNull($manager->getCreatedAt());
    }

    public function testSetData(): void
    {
        $manager = new Manager();
        $manager->setProjectIds([1]);
        $manager->setTmIds([2]);
        $manager->setGlossaryIds([3]);
        $manager->setStyleGuideIds([4]);

        $this->assertSame([1], $manager->getProjectIds());
        $this->assertSame([2], $manager->getTmIds());
        $this->assertSame([3], $manager->getGlossaryIds());
        $this->assertSame([4], $manager->getStyleGuideIds());
    }
}
