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
     * @param array $params
     * @return ModelCollection
     */
    public function list(array $params = []): ModelCollection
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
