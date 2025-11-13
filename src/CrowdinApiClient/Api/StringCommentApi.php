<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\StringComment;
use CrowdinApiClient\ModelCollection;

/**
 * Use API to add or remove strings translations, approvals, and votes.
 *
 * @package Crowdin\Api
 */
class StringCommentApi extends AbstractApi
{
    /**
     * List String Comment
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.comments.get API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.comments.getMany API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $params
     * @return ModelCollection|null
     */
    public function list(int $projectId, array $params = []): ?ModelCollection
    {
        $path = sprintf('projects/%d/comments', $projectId);
        return $this->_list($path, StringComment::class, $params);
    }

    /**
     * Get String Comment
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.comments.get API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.comments.get API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $stringCommentId
     * @return StringComment|null
     */
    public function get(int $projectId, int $stringCommentId): ?StringComment
    {
        $path = sprintf('projects/%d/comments/%d', $projectId, $stringCommentId);
        return $this->_get($path, StringComment::class);
    }

    /**
     * Add String Comment
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.comments.post API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.comments.post API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $data
     * @return StringComment|null
     */
    public function create(int $projectId, array $data): ?StringComment
    {
        $path = sprintf('projects/%d/comments', $projectId);
        return $this->_create($path, StringComment::class, $data);
    }

    /**
     * Edit String Comment
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.comments.patch API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.comments.patch API Documentation Enterprise
     *
     * @param int $projectId
     * @param StringComment $stringComment
     * @return StringComment|null
     */
    public function update(int $projectId, StringComment $stringComment): ?StringComment
    {
        $path = sprintf('projects/%d/comments/%d', $projectId, $stringComment->getId());
        return $this->_update($path, $stringComment);
    }

    /**
     * Delete String Comment
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.comments.delete API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.comments.delete API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $stringCommentId
     * @return mixed
     */
    public function delete(int $projectId, int $stringCommentId)
    {
        $path = sprintf('projects/%d/comments/%d', $projectId, $stringCommentId);
        return $this->_delete($path);
    }

    /**
     * String Comment Batch Operations
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.comments.batchPatch API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.comments.batchPatch API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $data
     * string $data[op] required Patch operation to perform (replace, test)<br>
     * string <json-pointer> $data[path] required A JSON Pointer as defined in RFC 6901<br>
     * value $data[value] required The value to be used within the operation (string, int, bool, or object)
     * @return mixed
     */
    public function batchOperations(int $projectId, array $data)
    {
        $path = sprintf('projects/%d/comments', $projectId);
        return $this->_patch($path, StringComment::class, $data);
    }
}
