<?php

declare(strict_types=1);

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\Discussion;
use CrowdinApiClient\Model\DiscussionReply;
use CrowdinApiClient\ModelCollection;

/**
 * Project discussions and their replies. Crowdin only.
 *
 * @package Crowdin\Api
 */
class DiscussionApi extends AbstractApi
{
    /**
     * List Project Discussions
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.discussions.getMany API Documentation
     *
     * @param int $projectId
     * @param array $params
     * string $params[status] open, closed or comma-separated list. Default is open<br>
     * string $params[userIds] One ID or comma-separated list<br>
     * string $params[languageIds] One ID or comma-separated list<br>
     * string $params[search] Title, description or reply text<br>
     * string $params[orderBy] id, title, createdAt, updatedAt or repliesCount. Default is updatedAt desc<br>
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function list(int $projectId, array $params = []): ModelCollection
    {
        return $this->_list(sprintf('projects/%d/discussions', $projectId), Discussion::class, $params);
    }

    /**
     * Get Project Discussion
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.discussions.get API Documentation
     *
     * @param int $projectId
     * @param int $discussionId
     * @return Discussion|null
     */
    public function get(int $projectId, int $discussionId): ?Discussion
    {
        return $this->_get(sprintf('projects/%d/discussions/%d', $projectId, $discussionId), Discussion::class);
    }

    /**
     * Add Project Discussion
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.discussions.post API Documentation
     *
     * @param int $projectId
     * @param array $data
     * string $data[title] required<br>
     * string $data[text] required. Markdown, posted as the first reply<br>
     * string $data[languageId] Omit for a discussion about all languages
     * @return Discussion|null
     */
    public function create(int $projectId, array $data): ?Discussion
    {
        return $this->_create(sprintf('projects/%d/discussions', $projectId), Discussion::class, $data);
    }

    /**
     * Edit Project Discussion
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.discussions.patch API Documentation
     *
     * @param int $projectId
     * @param Discussion $discussion Only title, status and isMuted can be changed
     * @return Discussion|null
     */
    public function update(int $projectId, Discussion $discussion): ?Discussion
    {
        return $this->_update(sprintf('projects/%d/discussions/%d', $projectId, $discussion->getId()), $discussion);
    }

    /**
     * Delete Project Discussion
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.discussions.delete API Documentation
     *
     * @param int $projectId
     * @param int $discussionId
     * @return mixed
     */
    public function delete(int $projectId, int $discussionId)
    {
        return $this->_delete(sprintf('projects/%d/discussions/%d', $projectId, $discussionId));
    }

    /**
     * List Discussion Replies
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.discussions.replies.getMany API Documentation
     *
     * @param int $projectId
     * @param int $discussionId
     * @param array $params
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function listReplies(int $projectId, int $discussionId, array $params = []): ModelCollection
    {
        $path = sprintf('projects/%d/discussions/%d/replies', $projectId, $discussionId);
        return $this->_list($path, DiscussionReply::class, $params);
    }

    /**
     * Get Discussion Reply
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.discussions.replies.get API Documentation
     *
     * @param int $projectId
     * @param int $discussionId
     * @param int $replyId
     * @return DiscussionReply|null
     */
    public function getReply(int $projectId, int $discussionId, int $replyId): ?DiscussionReply
    {
        $path = sprintf('projects/%d/discussions/%d/replies/%d', $projectId, $discussionId, $replyId);
        return $this->_get($path, DiscussionReply::class);
    }

    /**
     * Add Discussion Reply
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.discussions.replies.post API Documentation
     *
     * @param int $projectId
     * @param int $discussionId
     * @param array $data
     * string $data[text] required. Markdown
     * @return DiscussionReply|null
     */
    public function createReply(int $projectId, int $discussionId, array $data): ?DiscussionReply
    {
        $path = sprintf('projects/%d/discussions/%d/replies', $projectId, $discussionId);
        return $this->_create($path, DiscussionReply::class, $data);
    }

    /**
     * Edit Discussion Reply
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.discussions.replies.patch API Documentation
     *
     * @param int $projectId
     * @param DiscussionReply $reply Only text can be changed
     * @return DiscussionReply|null
     */
    public function updateReply(int $projectId, DiscussionReply $reply): ?DiscussionReply
    {
        $path = sprintf('projects/%d/discussions/%d/replies/%d', $projectId, $reply->getDiscussionId(), $reply->getId());
        return $this->_update($path, $reply);
    }

    /**
     * Delete Discussion Reply
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.discussions.replies.delete API Documentation
     *
     * @param int $projectId
     * @param int $discussionId
     * @param int $replyId
     * @return mixed
     */
    public function deleteReply(int $projectId, int $discussionId, int $replyId)
    {
        return $this->_delete(sprintf('projects/%d/discussions/%d/replies/%d', $projectId, $discussionId, $replyId));
    }
}
