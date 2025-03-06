<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\Issue;
use CrowdinApiClient\ModelCollection;

/**
 * @package Crowdin\Api
 * @deprecated Use StringCommentApi instead
 */
class IssueApi extends AbstractApi
{
    /**
     * List Reported Issues
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.issues.getMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.issues.getMany API Documentation Enterprise
     *
     * @deprecated Use StringCommentApi::list() instead
     */
    public function listReportedIssues(int $projectId, array $params = []): ?ModelCollection
    {
        $path = sprintf('projects/%d/issues', $projectId);
        return $this->_list($path, Issue::class, $params);
    }

    /**
     * Edit Issue
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.issues.patch API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.issues.patch API Documentation Enterprise
     *
     * @deprecated Use StringCommentApi::update() instead
     */
    public function update(int $projectId, Issue $issue): ?Issue
    {
        $path = sprintf('projects/%d/issues/%d', $projectId, $issue->getId());
        return $this->_update($path, $issue);
    }
}
