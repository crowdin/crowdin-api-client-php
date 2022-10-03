<?php

namespace CrowdinApiClient\Api\Enterprise;

use CrowdinApiClient\Api\AbstractApi;
use CrowdinApiClient\Model\Enterprise\WorkflowStep;
use CrowdinApiClient\ModelCollection;

/**
 * Use API to manage workflow steps
 *
 * @package Crowdin\Api\Enterprise
 */
class WorkflowStepApi extends AbstractApi
{
    /**
     * List Workflow Steps
     * @link https://developer.crowdin.com/enterprise/api/#operation/api.projects.workflow-steps.getMany API Documentation
     *
     * @param int $projectId
     * @param array $params
     * @return null|ModelCollection
     * integer $params[groupId]<br>
     * integer $params[limit]<br>
     * integer $params[offset]
     */
    public function list(int $projectId, array $params = []): ModelCollection
    {
        $path = sprintf('projects/%d/workflow-steps', $projectId);
        return $this->_list($path, WorkflowStep::class, $params);
    }

    /**
     * Get Workflow Step
     * @link https://developer.crowdin.com/enterprise/api/#operation/api.projects.workflow-steps.get API Documentation
     *
     * @param int $projectId
     * @param int $stepId
     * @return WorkflowStep|null
     */
    public function get(int $projectId, int $stepId): WorkflowStep
    {
        $path = sprintf('projects/%d/workflow-steps/%d', $projectId, $stepId);
        return $this->_get($path, WorkflowStep::class);
    }
}
