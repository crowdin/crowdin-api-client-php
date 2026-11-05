<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\Discussion;
use CrowdinApiClient\Model\DiscussionReply;
use CrowdinApiClient\ModelCollection;

class DiscussionApiTest extends AbstractTestApi
{
    public function testList(): void
    {
        $this->mockRequest([
            'path' => '/projects/2/discussions?status=open%2Cclosed&limit=10',
            'method' => 'get',
            'response' => json_encode([
                'data' => [['data' => $this->discussionData()]],
                'pagination' => ['offset' => 0, 'limit' => 10],
            ]),
        ]);

        $discussions = $this->crowdin->discussion->list(2, ['status' => 'open,closed', 'limit' => 10]);

        $this->assertInstanceOf(ModelCollection::class, $discussions);
        $this->assertCount(1, $discussions);
        $this->assertInstanceOf(Discussion::class, $discussions[0]);
        $this->assertEquals(7, $discussions[0]->getId());
    }

    public function testGet(): void
    {
        $this->mockRequest([
            'path' => '/projects/2/discussions/7',
            'method' => 'get',
            'response' => json_encode(['data' => $this->discussionData()]),
        ]);

        $discussion = $this->crowdin->discussion->get(2, 7);

        $this->assertInstanceOf(Discussion::class, $discussion);
        $this->assertEquals('Glossary for the mobile app', $discussion->getTitle());
    }

    public function testCreate(): void
    {
        $data = [
            'title' => 'Glossary for the mobile app',
            'text' => 'Let us agree on terms, @taras.m',
            'languageId' => 'uk',
        ];

        $this->mockRequest([
            'path' => '/projects/2/discussions',
            'method' => 'post',
            'body' => json_encode($data),
            'response' => json_encode(['data' => $this->discussionData()]),
        ]);

        $this->assertInstanceOf(Discussion::class, $this->crowdin->discussion->create(2, $data));
    }

    public function testUpdate(): void
    {
        $discussion = new Discussion($this->discussionData());
        $discussion->setStatus('closed');

        $this->mockRequest([
            'path' => '/projects/2/discussions/7',
            'method' => 'patch',
            'body' => json_encode([['op' => 'replace', 'path' => '/status', 'value' => 'closed']]),
            'response' => json_encode(['data' => ['status' => 'closed'] + $this->discussionData()]),
        ]);

        $updated = $this->crowdin->discussion->update(2, $discussion);

        $this->assertInstanceOf(Discussion::class, $updated);
        $this->assertEquals('closed', $updated->getStatus());
    }

    public function testDelete(): void
    {
        $this->mockRequestDelete('/projects/2/discussions/7');
        $this->crowdin->discussion->delete(2, 7);
    }

    public function testListReplies(): void
    {
        $this->mockRequest([
            'path' => '/projects/2/discussions/7/replies',
            'method' => 'get',
            'response' => json_encode([
                'data' => [['data' => $this->replyData()]],
                'pagination' => ['offset' => 0, 'limit' => 25],
            ]),
        ]);

        $replies = $this->crowdin->discussion->listReplies(2, 7);

        $this->assertInstanceOf(ModelCollection::class, $replies);
        $this->assertCount(1, $replies);
        $this->assertInstanceOf(DiscussionReply::class, $replies[0]);
        $this->assertEquals(31, $replies[0]->getId());
    }

    public function testGetReply(): void
    {
        $this->mockRequest([
            'path' => '/projects/2/discussions/7/replies/31',
            'method' => 'get',
            'response' => json_encode(['data' => $this->replyData()]),
        ]);

        $reply = $this->crowdin->discussion->getReply(2, 7, 31);

        $this->assertInstanceOf(DiscussionReply::class, $reply);
        $this->assertEquals('reply', $reply->getType());
    }

    public function testCreateReply(): void
    {
        $data = ['text' => 'Agreed'];

        $this->mockRequest([
            'path' => '/projects/2/discussions/7/replies',
            'method' => 'post',
            'body' => json_encode($data),
            'response' => json_encode(['data' => $this->replyData()]),
        ]);

        $this->assertInstanceOf(DiscussionReply::class, $this->crowdin->discussion->createReply(2, 7, $data));
    }

    public function testUpdateReply(): void
    {
        $reply = new DiscussionReply($this->replyData());
        $reply->setText('Agreed, thanks');

        $this->mockRequest([
            'path' => '/projects/2/discussions/7/replies/31',
            'method' => 'patch',
            'body' => json_encode([['op' => 'replace', 'path' => '/text', 'value' => 'Agreed, thanks']]),
            'response' => json_encode(['data' => ['text' => 'Agreed, thanks'] + $this->replyData()]),
        ]);

        $updated = $this->crowdin->discussion->updateReply(2, $reply);

        $this->assertInstanceOf(DiscussionReply::class, $updated);
        $this->assertEquals('Agreed, thanks', $updated->getText());
    }

    public function testDeleteReply(): void
    {
        $this->mockRequestDelete('/projects/2/discussions/7/replies/31');
        $this->crowdin->discussion->deleteReply(2, 7, 31);
    }

    private function discussionData(): array
    {
        return [
            'id' => 7,
            'projectId' => 2,
            'title' => 'Glossary for the mobile app',
            'status' => 'open',
            'languageId' => 'uk',
            'userId' => 12,
            'user' => ['id' => 12, 'username' => 'john.smith', 'fullName' => 'John Smith', 'avatarUrl' => ''],
            'repliesCount' => 3,
            'isMuted' => false,
            'createdAt' => '2026-10-20T10:00:00+00:00',
            'updatedAt' => '2026-10-21T10:00:00+00:00',
        ];
    }

    private function replyData(): array
    {
        return [
            'id' => 31,
            'discussionId' => 7,
            'type' => 'reply',
            'text' => 'Agreed',
            'userId' => 13,
            'user' => ['id' => 13, 'username' => 'taras.m', 'fullName' => 'Taras M', 'avatarUrl' => ''],
            'createdAt' => '2026-10-21T10:00:00+00:00',
            'updatedAt' => '2026-10-21T10:00:00+00:00',
        ];
    }
}
