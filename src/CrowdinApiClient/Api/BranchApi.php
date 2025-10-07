<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\Branch;
use CrowdinApiClient\ModelCollection;

/**
 * Manage project branches
 *
 * Note: If you use branches, make sure your master branch is the first one you integrate with Crowdin.
 *
 * @package Crowdin\Api
 */
class BranchApi extends AbstractApi
{
    /**
     * List Branches
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.branches.getMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.branches.getMany API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $params
     * string $params[name]<br>
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function list(int $projectId, array $params = []): ModelCollection
    {
        $path = sprintf('projects/%d/branches', $projectId);
        return $this->_list($path, Branch::class, $params);
    }

    /**
     * List All Branches (Handles Pagination)
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.branches.getMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.branches.getMany API Documentation Enterprise
     *
     * @param int $projectId
     * @return ModelCollection
     */
    public function listAll(int $projectId): ModelCollection
    {
        return $this->_listAll('projects/' . $projectId . '/branches', Branch::class);
    }
    
    /**
     * Get Branch Info
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.branches.get API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.branches.get API Documentation Enterprise
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
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.branches.post API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.branches.post API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $data
     * string $data[name] required Note: Can't contain \\ / : * ? \" < > | symbols<br>
     * string $data[title]<br>
     * string $data[exportPattern] Note: Can't contain \\ / : * ? \" < > | symbols<br>
     * string $data[priority] Enum: "low" "normal" "high"
     * @return Branch|null
     */
    public function create(int $projectId, array $data): ?Branch
    {
        $path = sprintf('projects/%d/branches', $projectId);
        return $this->_create($path, Branch::class, $data);
    }

    /**
     * Edit Branch
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.branches.patch API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.branches.patch API Documentation Enterprise
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
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.branches.delete API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.branches.delete API Documentation Enterprise
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
