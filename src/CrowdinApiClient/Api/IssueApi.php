<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\Issue;
use CrowdinApiClient\ModelCollection;

/**
 * Class IssueApi
 * @package CrowdinApiClient\Api
 */
class IssueApi extends AbstractApi
{
    /**
     * List Reported Issues
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.issues.getMany API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.issues.getMany API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $params
     * @internal integer $params[limit] default 25
     * @internal integer $params[offset] default 0
     * @return Issue|null
     */
    public function listReportedIssues(int $projectId, array $params = []): ?ModelCollection
    {
        $path = sprintf('projects/%d/issues', $projectId);
        return $this->_list($path, Issue::class, $params);
    }

    /**
     * Edit Issue
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.issues.patch API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.issues.patch API Documentation Enterprise
     *
     * @param int $projectId
     * @param Issue $issue
     * @return Issue
     */
    public function update(int $projectId, Issue $issue): Issue
    {
        $path = sprintf('projects/%d/issues/%d', $projectId, $issue->getId());
        return $this->_update($path, $issue);
    }
}
