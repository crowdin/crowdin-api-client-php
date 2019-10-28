<?php


namespace Crowdin\Api;


use Crowdin\Api\Traits\GrudTrait;
use Crowdin\Http\ResponseDecorator\ResponseModelDecorator;
use Crowdin\Http\ResponseDecorator\ResponseModelListDecorator;
use Crowdin\Model\Branch;

/**
 * Class BranchApi
 * @package Crowdin\Api
 */
class BranchApi extends AbstractApi
{
    use GrudTrait;

    /**
     * @param int $projectId
     * @return mixed
     */
    public function list(int $projectId)
    {
        $path = sprintf('/projects/%d/branches', $projectId);
        return $this->_list($path, Branch::class);
    }

    /**
     * @param int $projectId
     * @param int $branchId
     * @return Branch|null
     */
    public function get(int $projectId, int $branchId):?Branch
    {
        $path = sprintf('/projects/%d/branches/%d', $projectId, $branchId);
        return $this->_get($path, Branch::class);
    }

    /**
     * @param int $projectId
     * @param array $data
     * @return Branch|null
     */
    public function create(int $projectId, array $data):?Branch
    {
        $path = sprintf('/projects/%d/branches', $projectId);
        return $this->_create($path, Branch::class, $data);
    }

    /**
     * @param Branch $branch
     * @return Branch|null
     */
    public function update(Branch $branch):?Branch
    {
        //TODO not valid patch
        //return $this->_update('branches', $branch);
    }

    /**
     * @param int $projectId
     * @param int $branchId
     * @return mixed
     */
    public function delete(int $projectId, int $branchId)
    {
        $path = sprintf('/projects/%d/branches/%d', $projectId, $branchId);
        return $this->_delete($path);
    }
}
