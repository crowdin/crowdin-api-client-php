<?php

namespace CrowdinApiClient\Api\Enterprise;

use CrowdinApiClient\Api\AbstractApi;
use CrowdinApiClient\Model\Enterprise\WorkflowTemplate;
use CrowdinApiClient\ModelCollection;

/**
 * Workflows are the sequences of steps that content in your project should go through (e.g. pre-translation, translation, proofreading).
 * You can use a default template or create the one that works best for you and assign it to the needed projects.
 * Use API to get the list of workflow templates available in your organization and to check the details of a specific template.
 * @package Crowdin\Api\Enterprise
 */
class WorkflowTemplateApi extends AbstractApi
{
    /**
     * List Workflow Templates
     * @link https://support.crowdin.com/enterprise/api/#operation/api.workflow-templates.getMany API Documentation
     *
     * @param array $params
     * integer $params[groupId]<br>
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function list(array $params = []): ModelCollection
    {
        return $this->_list('workflow-templates', WorkflowTemplate::class, $params);
    }

    /**
     * Get Workflow Template Info
     * @link https://support.crowdin.com/enterprise/api/#operation/api.workflow-templates.get API Documentation
     *
     * @param int $templateId
     * @return WorkflowTemplate|null
     */
    public function get(int $templateId): ?WorkflowTemplate
    {
        return $this->_get('workflow-templates/' . $templateId, WorkflowTemplate::class);
    }
}
