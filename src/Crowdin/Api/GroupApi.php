<?php


namespace Crowdin\Api;

use Crowdin\Model\Group;

/**
 * Class GroupApi
 * @package Crowdin\Api
 */
class GroupApi extends AbstractApi
{

    public function list()
    {
        return $this->_list('groups', Group::class);
    }

    /**
     * @param int $groupID
     * @return Group|null
     */
    public function get(int $groupID):?Group
    {
        return $this->_get('groups/'.$groupID, Group::class);
    }

    /**
     * @param array $data
     * @return Group|null
     * @internal param integer $parentId
     * @internal param description $description
     * @internal param string $name
     */
    public function create(array $data):?Group
    {
        return $this->_create('groups',  Group::class, $data);
    }

    /**
     * @param Group $group
     * @return Group|mixed
     */
    public function update(Group $group):Group
    {
        return  $this->_update('groups/'.$group->getId(), $group);
    }

    /**
     * @param int $groupID
     * @return mixed
     */
    public function delete(int $groupID)
    {
        return $this->_delete('groups/' . $groupID);
    }
}
