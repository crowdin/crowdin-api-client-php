<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\StringTranslation;
use CrowdinApiClient\Model\StringTranslationApproval;
use CrowdinApiClient\Model\Vote;
use CrowdinApiClient\ModelCollection;

/**
 * Class StringTranslationApi
 * @package Crowdin\Api
 */
class StringTranslationApi extends AbstractApi
{
    /**
     * @param int $projectId
     * @param array $params
     * @return ModelCollection
     */
    public function list(int $projectId, array $params = []): ModelCollection
    {
        $path = sprintf('projects/%d/translations', $projectId);
        return $this->_list($path, StringTranslation::class, $params);
    }

    /**
     * @param int $projectId
     * @param int $translationId
     * @return StringTranslation|null
     */
    public function get(int $projectId, int $translationId): ?StringTranslation
    {
        $path = sprintf('projects/%d/translations/%d', $projectId, $translationId);
        return $this->_get($path, StringTranslation::class);
    }

    /**
     * @param int $projectId
     * @param array $data
     * @return StringTranslation|null
     */
    public function create(int $projectId, array $data): ?StringTranslation
    {
        $path = sprintf('projects/%d/translations', $projectId);
        return $this->_create($path, StringTranslation::class, $data);
    }

    /**
     * @param int $projectId
     * @param int $translationId
     * @return StringTranslation|null
     */
    public function restore(int $projectId, int $translationId): ?StringTranslation
    {
        $path = sprintf('projects/%d/translations/%d/restore', $projectId, $translationId);

        return $this->_post($path, StringTranslation::class, []);
    }

    /**
     * @param int $projectId
     * @param int $translationId
     * @return mixed
     */
    public function delete(int $projectId, int $translationId)
    {
        $path = sprintf('projects/%d/translations/%d', $projectId, $translationId);
        return $this->_delete($path);
    }

    /**
     * @param int $projectId
     * @param array $params
     * @return ModelCollection
     */
    public function listApprovals(int $projectId, array $params = []): ModelCollection
    {
        $path = sprintf('projects/%s/approvals', $projectId);
        return $this->_list($path, StringTranslationApproval::class, $params);
    }

    /**
     * @param int $projectId
     * @param int $approvalId
     * @return StringTranslationApproval|null
     */
    public function getApproval(int $projectId, int $approvalId): ?StringTranslationApproval
    {
        $path = sprintf('projects/%d/approvals/%d', $projectId, $approvalId);

        return $this->_get($path, StringTranslationApproval::class);
    }

    /**
     * @param int $projectId
     * @param array $data
     * @return StringTranslationApproval|null
     */
    public function createApproval(int $projectId, array $data): ?StringTranslationApproval
    {
        $path = sprintf('projects/%d/approvals', $projectId);

        return $this->_create($path, StringTranslationApproval::class, $data);
    }

    /**
     * @param int $projectId
     * @param int $approvalId
     * @return mixed
     */
    public function deleteApproval(int $projectId, int $approvalId)
    {
        $path = sprintf('projects/%d/approvals/%d', $projectId, $approvalId);
        return $this->_delete($path);
    }

    /**
     * @param int $projectId
     * @param array $params
     * @return ModelCollection
     */
    public function listVotes(int $projectId, array $params = []): ModelCollection
    {
        $path = sprintf('projects/%d/votes', $projectId);
        return $this->_list($path, Vote::class, $params);
    }

    /**
     * @param int $projectId
     * @param int $voteId
     * @return Vote|null
     */
    public function getVote(int $projectId, int $voteId): ?Vote
    {
        $path = sprintf('projects/%d/votes/%d', $projectId, $voteId);

        return  $this->_get($path, Vote::class);
    }

    /**
     * @param int $projectId
     * @param array $data
     * @return Vote|null
     */
    public function createVote(int $projectId, array $data): ?Vote
    {
        $path = sprintf('projects/%d/votes', $projectId);
        return $this->_create($path, Vote::class, $data);
    }

    /**
     * @param int $projectId
     * @param int $voteId
     * @return mixed
     */
    public function deleteVote(int $projectId, int $voteId)
    {
        $path = sprintf('projects/%d/votes/%d', $projectId, $voteId);
        return $this->_delete($path);
    }
}
