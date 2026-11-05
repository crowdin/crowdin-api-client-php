<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\Discussion;
use PHPUnit\Framework\TestCase;

class DiscussionTest extends TestCase
{
    public function testLoadData(): void
    {
        $data = [
            'id' => 7,
            'projectId' => 2,
            'title' => 'Glossary for the mobile app',
            'status' => 'open',
            'languageId' => 'uk',
            'userId' => 12,
            'user' => ['id' => 12, 'username' => 'john.smith', 'fullName' => 'John Smith', 'avatarUrl' => ''],
            'repliesCount' => 3,
            'isMuted' => true,
            'createdAt' => '2026-10-20T10:00:00+00:00',
            'updatedAt' => '2026-10-21T10:00:00+00:00',
        ];

        $discussion = new Discussion($data);

        $this->assertSame($data['id'], $discussion->getId());
        $this->assertSame($data['projectId'], $discussion->getProjectId());
        $this->assertSame($data['title'], $discussion->getTitle());
        $this->assertSame($data['status'], $discussion->getStatus());
        $this->assertSame($data['languageId'], $discussion->getLanguageId());
        $this->assertSame($data['userId'], $discussion->getUserId());
        $this->assertSame($data['user'], $discussion->getUser());
        $this->assertSame($data['repliesCount'], $discussion->getRepliesCount());
        $this->assertTrue($discussion->isMuted());
        $this->assertSame($data['createdAt'], $discussion->getCreatedAt());
        $this->assertSame($data['updatedAt'], $discussion->getUpdatedAt());
    }

    public function testLoadDataWithoutOptionalFields(): void
    {
        $discussion = new Discussion(['id' => 7, 'title' => 'All languages', 'languageId' => null]);

        $this->assertNull($discussion->getLanguageId());
        $this->assertSame([], $discussion->getUser());
        $this->assertFalse($discussion->isMuted());
    }

    public function testSetData(): void
    {
        $discussion = new Discussion();
        $discussion->setTitle('New title');
        $discussion->setStatus('closed');
        $discussion->setIsMuted(true);

        $this->assertSame('New title', $discussion->getTitle());
        $this->assertSame('closed', $discussion->getStatus());
        $this->assertTrue($discussion->isMuted());
    }
}
