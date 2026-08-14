<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\Branch;
use CrowdinApiClient\Model\BranchClone;
use CrowdinApiClient\Model\BranchMerge;
use CrowdinApiClient\Model\BranchMergeSummary;
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
     * string $data[priority] Enum: "low" "normal" "high"<br>
     * bool $data[isProtected] String-based projects only
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

    /**
     * Clone Branch
     * @link https://developer.crowdin.com/api/v2/string-based/#operation/api.projects.branches.clones.post API Documentation
     *
     * @param int $projectId
     * @param int $branchId
     * @param array $data
     * string $data[name] required Note: Can't contain \\ / : * ? \" < > | symbols<br>
     * string $data[title]<br>
     * bool $data[isProtected]
     * @return BranchClone|null
     */
    public function cloneBranch(int $projectId, int $branchId, array $data): ?BranchClone
    {
        $path = sprintf('projects/%d/branches/%d/clones', $projectId, $branchId);
        return $this->_post($path, BranchClone::class, $data);
    }

    /**
     * Check Branch Clone Status
     * @link https://developer.crowdin.com/api/v2/string-based/#operation/api.projects.branches.clones.get API Documentation
     *
     * @param int $projectId
     * @param int $branchId
     * @param string $cloneId
     * @return BranchClone|null
     */
    public function checkCloneStatus(int $projectId, int $branchId, string $cloneId): ?BranchClone
    {
        $path = sprintf('projects/%d/branches/%d/clones/%s', $projectId, $branchId, $cloneId);
        return $this->_get($path, BranchClone::class);
    }

    /**
     * Get Cloned Branch
     * @link https://developer.crowdin.com/api/v2/string-based/#operation/api.projects.branches.clones.branch.get API Documentation
     *
     * @param int $projectId
     * @param int $branchId
     * @param string $cloneId
     * @return Branch|null
     */
    public function getClonedBranch(int $projectId, int $branchId, string $cloneId): ?Branch
    {
        $path = sprintf('projects/%d/branches/%d/clones/%s/branch', $projectId, $branchId, $cloneId);
        return $this->_get($path, Branch::class);
    }

    /**
     * Merge Branch
     * @link https://developer.crowdin.com/api/v2/string-based/#operation/api.projects.branches.merges.post API Documentation
     *
     * @param int $projectId
     * @param int $branchId
     * @param array $data
     * int $data[sourceBranchId] required<br>
     * bool $data[deleteAfterMerge]<br>
     * bool $data[dryRun]<br>
     * bool $data[acceptSourceChanges]
     * @return BranchMerge|null
     */
    public function mergeBranch(int $projectId, int $branchId, array $data): ?BranchMerge
    {
        $path = sprintf('projects/%d/branches/%d/merges', $projectId, $branchId);
        return $this->_post($path, BranchMerge::class, $data);
    }

    /**
     * Check Branch Merge Status
     * @link https://developer.crowdin.com/api/v2/string-based/#operation/api.projects.branches.merges.get API Documentation
     *
     * @param int $projectId
     * @param int $branchId
     * @param string $mergeId
     * @return BranchMerge|null
     */
    public function checkMergeStatus(int $projectId, int $branchId, string $mergeId): ?BranchMerge
    {
        $path = sprintf('projects/%d/branches/%d/merges/%s', $projectId, $branchId, $mergeId);
        return $this->_get($path, BranchMerge::class);
    }

    /**
     * Get Branch Merge Summary
     * @link https://developer.crowdin.com/api/v2/string-based/#operation/api.projects.branches.merges.summary.get API Documentation
     *
     * @param int $projectId
     * @param int $branchId
     * @param string $mergeId
     * @return BranchMergeSummary|null
     */
    public function getMergeSummary(int $projectId, int $branchId, string $mergeId): ?BranchMergeSummary
    {
        $path = sprintf('projects/%d/branches/%d/merges/%s/summary', $projectId, $branchId, $mergeId);
        return $this->_get($path, BranchMergeSummary::class);
    }
}
