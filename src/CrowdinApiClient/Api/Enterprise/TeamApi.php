<?php

namespace CrowdinApiClient\Api\Enterprise;

use CrowdinApiClient\Api\AbstractApi;
use CrowdinApiClient\Model\Enterprise\Team;
use CrowdinApiClient\ModelCollection;

class TeamApi extends AbstractApi
{
    /**
     * List Teams
     * @link https://support.crowdin.com/enterprise/api/#operation/api.teams.getMany API Documentation
     *
     * @param array $params
     * @return ModelCollection
     */
    public function list(array $params = []): ModelCollection
    {
        return $this->_list('teams', Team::class, $params);
    }

    /**
     * Add Team
     * @link https://support.crowdin.com/enterprise/api/#operation/api.teams.post API Documentation
     *
     * @param array $data
     * @internal string $data[name]
     * @return Team
     */
    public function create(array $data): Team
    {
        return $this->_post('teams', Team::class, $data);
    }

    /**
     * Get Team
     * @link https://support.crowdin.com/enterprise/api/#operation/api.teams.post
     *
     * @param int $teamId
     * @return Team
     */
    public function get(int $teamId): Team
    {
        return $this->_get('teams/' . $teamId, Team::class);
    }

    /**
     * Delete Team
     * @link https://support.crowdin.com/enterprise/api/#operation/api.teams.delete API Documentation
     *
     * @param int $teamId
     * @return mixed
     */
    public function delete(int $teamId)
    {
        return $this->_delete('teams/' . $teamId);
    }

    /**
     * @param Team $team
     * @return Team
     */
    public function update(Team $team): Team
    {
        return $this->_update('teams/' . $team->getId(), $team);
    }
}
