<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\Branch;

/**
 * Class BranchApi
 * @package Crowdin\Api
 */
class BranchApi extends AbstractApi
{
    /**
     * @param int $projectId
     * @param array $params
     * @return mixed
     */
    public function list(int $projectId, array $params = [])
    {
        $path = sprintf('projects/%d/branches', $projectId);
        return $this->_list($path, Branch::class, $params);
    }

    /**
     * @param int $projectId
     * @param int $branchId
     * @return Branch|null
     */
    public function get(int $projectId, int $branchId): ?Branch
    {
        $path = sprintf('projects/%d/branches/%d', $projectId, $branchId);
        return $this->_get($path, Branch::class);
    }

    /**
     * @param int $projectId
     * @param array $data
     * @return Branch|null
     */
    public function create(int $projectId, array $data): ?Branch
    {
        $path = sprintf('projects/%d/branches', $projectId);
        return $this->_create($path, Branch::class, $data);
    }

    /**
     * @param Branch $branch
     * @return Branch|null
     */
    public function update(Branch $branch): ?Branch
    {
        $path = sprintf('projects/%d/branches/%d', $branch->getProjectId(), $branch->getId());

        return $this->_update($path, $branch);
    }

    /**
     * @param int $projectId
     * @param int $branchId
     * @return mixed
     */
    public function delete(int $projectId, int $branchId)
    {
        $path = sprintf('projects/%d/branches/%d', $projectId, $branchId);
        return $this->_delete($path);
    }
}
