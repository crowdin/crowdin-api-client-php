<?php

namespace CrowdinApiClient\Api\Enterprise;

use CrowdinApiClient\Api\AbstractApi;
use CrowdinApiClient\Model\Enterprise\WorkflowTemplate;
use CrowdinApiClient\ModelCollection;

/**
 * Class WorkflowTemplateApi
 * @package Crowdin\Api
 */
class WorkflowTemplateApi extends AbstractApi
{
    /**
     * List Workflow Templates
     * @link https://support.crowdin.com/enterprise/api/#operation/api.workflow-templates.getMany API Documentation
     *
     * @param array $params
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
