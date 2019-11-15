<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\WorkflowTemplate;

/**
 * Class WorkflowTemplateApi
 * @package Crowdin\Api
 */
class WorkflowTemplateApi extends AbstractApi
{
    /**
     * @param array $params
     * @return mixed
     */
    public function list(array $params = [])
    {
        return $this->_list('workflow-templates', WorkflowTemplate::class, $params);
    }

    /**
     * @param int $templateId
     * @return WorkflowTemplate|null
     */
    public function get(int $templateId): ?WorkflowTemplate
    {
        return $this->_get('workflow-templates/' . $templateId, WorkflowTemplate::class);
    }
}
