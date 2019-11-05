<?php


namespace Crowdin\Api;


use Crowdin\Model\WorkflowTemplate;

/**
 * Class WorkflowTemplateApi
 * @package Crowdin\Api
 */
class WorkflowTemplateApi extends AbstractApi
{
    /**
     * @return mixed
     */
    public function list()
    {
        return $this->_list('workflow-templates', WorkflowTemplate::class);
    }

    /**
     * @param int $templateId
     * @return WorkflowTemplate|null
     */
    public function get(int $templateId):?WorkflowTemplate
    {
        return $this->_get('workflow-templates/'.$templateId, WorkflowTemplate::class);
    }
}
