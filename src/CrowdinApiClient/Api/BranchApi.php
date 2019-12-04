<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\Branch;
use CrowdinApiClient\ModelCollection;

/**
 * Class BranchApi
 * @package Crowdin\Api
 */
class BranchApi extends AbstractApi
{
    /**
     * List Branches
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.branches.getMany API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.branches.getMany API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $params
     * @internal string $params[name]
     * @internal integer $params[limit]
     * @internal integer $params[offset]
     * @return ModelCollection
     */
    public function list(int $projectId, array $params = []): ModelCollection
    {
        $path = sprintf('projects/%d/branches', $projectId);
        return $this->_list($path, Branch::class, $params);
    }

    /**
     * Get Branch Info
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.branches.get API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.branches.get API Documentation Enterprise
     *
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
     * Add Branch
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.branches.post API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.branches.post API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $data
     * @internal string $data[name] required Note: Can't contain \\ / : * ? \" < > | symbols
     * @internal string $data[title]
     * @internal string $data[exportPattern] Note: Can't contain \\ / : * ? \" < > | symbols
     * @internal string $data[priority] Enum: "low" "normal" "high"
     * @return Branch|null
     */
    public function create(int $projectId, array $data): ?Branch
    {
        $path = sprintf('projects/%d/branches', $projectId);
        return $this->_create($path, Branch::class, $data);
    }

    /**
     * Edit Branch
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.branches.patch API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.branches.patch API Documentation Enterprise
     *
     * @param Branch $branch
     * @return Branch|null
     */
    public function update(Branch $branch): ?Branch
    {
        $path = sprintf('projects/%d/branches/%d', $branch->getProjectId(), $branch->getId());

        return $this->_update($path, $branch);
    }

    /**
     * Delete Branch
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.branches.delete API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.branches.delete API Documentation Enterprise
     *
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
