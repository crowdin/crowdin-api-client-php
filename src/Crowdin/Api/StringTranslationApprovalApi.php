<?php


namespace Crowdin\Api;

use Crowdin\Api\Traits\GrudTrait;
use Crowdin\Model\StringTranslationApproval;

/**
 * Class StringTranslationApprovalApi
 * @package Crowdin\Api
 */
class StringTranslationApprovalApi extends AbstractApi
{
    use GrudTrait;

    /**
     * @param int $projectId
     * @return mixed
     */
    public function list(int $projectId)
    {
        $path = sprintf('projects/%s/approvals', $projectId);
        return $this->_list($path, StringTranslationApproval::class);
    }

    /**
     * @param int $projectId
     * @param int $approvalId
     * @return StringTranslationApproval|null
     */
    public function get(int $projectId, int $approvalId):?StringTranslationApproval
    {
        $path = sprintf('/projects/%d/approvals/%d', $projectId, $approvalId);

        return $this->_get($path, StringTranslationApproval::class);
    }

    /**
     * @param int $projectId
     * @param array $data
     * @return StringTranslationApproval|null
     */
    public function create(int $projectId, array $data):?StringTranslationApproval
    {
        $path = sprintf('/projects/%s/approvals', $projectId);

        return $this->_create($path, StringTranslationApproval::class, $data);
    }


    public function update()
    {
        //TODO
    }

    /**
     * @param int $projectId
     * @param int $approvalId
     * @return mixed
     */
    public function delete(int $projectId, int $approvalId)
    {
        $path = sprintf('/projects/%d/approvals/%d', $projectId, $approvalId);
        return $this->_delete($path);
    }
}
