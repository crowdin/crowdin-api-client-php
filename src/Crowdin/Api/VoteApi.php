<?php

namespace Crowdin\Api;

use Crowdin\Model\Vote;

/**
 * Class VoteApi
 * @package Crowdin\Api
 */
class VoteApi extends AbstractApi
{
    public function list(int $projectId)
    {
        $path = sprintf('projects/%d/votes', $projectId);
        return $this->_list($path, Vote::class);
    }

    /**
     * @param int $projectId
     * @param int $voteId
     * @return Vote|null
     */
    public function get(int $projectId, int $voteId): ?Vote
    {
        $path = sprintf('projects/%d/votes/%d', $projectId, $voteId);

        return  $this->_get($path, Vote::class);
    }

    /**
     * @param int $projectId
     * @param array $data
     * @return Vote|null
     */
    public function create(int $projectId, array $data): ?Vote
    {
        $path = sprintf('projects/%d/votes', $projectId);
        return $this->_create($path, Vote::class, $data);
    }

    public function update(Vote $vote)
    {
        //TODO
    }

    /**
     * @param int $projectId
     * @param int $voteId
     * @return mixed
     */
    public function delete(int $projectId, int $voteId)
    {
        $path = sprintf('/projects/%d/votes/%d', $projectId, $voteId);
        return $this->_delete($path);
    }
}
