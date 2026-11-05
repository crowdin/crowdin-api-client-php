<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\DiscussionReply;
use PHPUnit\Framework\TestCase;

class DiscussionReplyTest extends TestCase
{
    public function testLoadData(): void
    {
        $data = [
            'id' => 31,
            'discussionId' => 7,
            'type' => 'description',
            'text' => 'Let us agree on terms',
            'userId' => 13,
            'user' => ['id' => 13, 'username' => 'taras.m', 'fullName' => 'Taras M', 'avatarUrl' => ''],
            'createdAt' => '2026-10-21T10:00:00+00:00',
            'updatedAt' => '2026-10-22T10:00:00+00:00',
        ];

        $reply = new DiscussionReply($data);

        $this->assertSame($data['id'], $reply->getId());
        $this->assertSame($data['discussionId'], $reply->getDiscussionId());
        $this->assertSame($data['type'], $reply->getType());
        $this->assertSame($data['text'], $reply->getText());
        $this->assertSame($data['userId'], $reply->getUserId());
        $this->assertSame($data['user'], $reply->getUser());
        $this->assertSame($data['createdAt'], $reply->getCreatedAt());
        $this->assertSame($data['updatedAt'], $reply->getUpdatedAt());
    }

    public function testLoadDataWithoutOptionalFields(): void
    {
        $reply = new DiscussionReply(['id' => 32, 'discussionId' => 7, 'type' => 'system', 'text' => 'closed']);

        $this->assertSame('system', $reply->getType());
        $this->assertSame([], $reply->getUser());
    }

    public function testSetData(): void
    {
        $reply = new DiscussionReply();
        $reply->setText('Edited');

        $this->assertSame('Edited', $reply->getText());
    }
}
