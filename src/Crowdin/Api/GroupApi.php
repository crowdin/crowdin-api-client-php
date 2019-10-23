<?php


namespace Crowdin\Api;

use Crowdin\Http\ResponseDecorator\ResponseModelListDecorator;
use Crowdin\Model\Group;

/**
 * Class GroupApi
 * @package Crowdin\Api
 */
class GroupApi extends AbstractApi
{
    public function all()
    {
        return $this->client->apiRequest('get', 'groups', new ResponseModelListDecorator(Group::class));
    }
}
