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
     * @deprecated Use StringCommentApi::list() instead
     *
     * List Reported Issues
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.issues.getMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.issues.getMany API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $params
     * string $params[type]<br>
     * string $params[status]
     * @return ModelCollection|null
     */
    public function listReportedIssues(int $projectId, array $params = []): ?ModelCollection
    {
        $path = sprintf('projects/%d/issues', $projectId);
        return $this->_list($path, Issue::class, $params);
    }

    /**
     * @deprecated Use StringCommentApi::update() instead
     *
     * Edit Issue
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.issues.patch API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.issues.patch API Documentation Enterprise
     */
    public function update(int $projectId, Issue $issue): ?Issue
    {
        $path = sprintf('projects/%d/issues/%d', $projectId, $issue->getId());
        return $this->_update($path, $issue);
    }
}
