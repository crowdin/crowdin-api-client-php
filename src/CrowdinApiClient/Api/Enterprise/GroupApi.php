<?php

namespace CrowdinApiClient\Api\Enterprise;

use CrowdinApiClient\Api\AbstractApi;
use CrowdinApiClient\Model\Enterprise\Group;
use CrowdinApiClient\ModelCollection;

/**
 * Class GroupApi
 * @package Crowdin\Api
 */
class GroupApi extends AbstractApi
{
    /**
     * List Groups
     * @link https://support.crowdin.com/enterprise/api/#operation/api.groups.getMany API Documentation
     *
     * @param array $params
     * @return ModelCollection
     */
    public function list(array $params = []): ModelCollection
    {
        return $this->_list('groups', Group::class, $params);
    }

    /**
     * Get Group Info
     * @link https://support.crowdin.com/enterprise/api/#operation/api.groups.get API Documentation
     *
     * @param int $groupID
     * @return Group|null
     */
    public function get(int $groupID): ?Group
    {
        return $this->_get('groups/' . $groupID, Group::class);
    }

    /**
     * Add Group
     * @link https://support.crowdin.com/enterprise/api/#operation/api.groups.post API Documentation
     *
     * @param array $data
     * @return Group|null
     * @internal integer $data[parentId]
     * @internal string $data[description]
     * @internal string $data[name] required
     */
    public function create(array $data): ?Group
    {
        return $this->_create('groups', Group::class, $data);
    }

    /**
     * Edit Group
     * @link https://support.crowdin.com/enterprise/api/#operation/api.groups.patch API Documentation
     *
     * @param Group $group
     * @return Group|mixed
     */
    public function update(Group $group): Group
    {
        return  $this->_update('groups/' . $group->getId(), $group);
    }

    /**
     * Delete Group
     * @link https://support.crowdin.com/enterprise/api/#operation/api.groups.delete API Documentation
     *
     * @param int $groupID
     * @return mixed
     */
    public function delete(int $groupID)
    {
        return $this->_delete('groups/' . $groupID);
    }
}
